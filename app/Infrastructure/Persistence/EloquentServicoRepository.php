<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Repositories\ServicoRepositoryInterface;
use App\Models\Servico as ModelServico;
use App\Domain\Entities\Servico as EntityServico;

class EloquentServicoRepository implements ServicoRepositoryInterface{

    public function findById(int $id): ?EntityServico {
        $model = ModelServico::find($id);
        return $model ? new ModelServico($model->nome, $model->categoria, $model->descricao) : null;
    }

    public function save(EntityServico $servico): void { 

        ModelServico::create([
            'nome_servico' => $servico->nome_servico,
            'categoria' => $servico->categoria,
            'descricao' => $servico->desc_servico,

        ]);
    }    
use App\Domain\Entities\Servico;
use App\Domain\Entities\Categoria;
use App\Domain\Entities\Usuario;
use App\Domain\Repositories\ServicoRepositoryInterface;
use App\Models\Servico as EloquentServico;

class EloquentServicoRepository implements ServicoRepositoryInterface
{
    public function getAll(): array
    {
        $models = EloquentServico::with('categoria')->get();

        return $models->map(function ($model) {
            $categoria = new Categoria(
                id: $model->categoria->id,
                categoria: $model->categoria->categoria
            );

            return new Servico(
                id: $model->id,
                nome_servico: $model->nome_servico,
                categoria: $categoria,
                desc_servico: $model->desc_servico,
                caminho_img: $model->caminho_img,
                usuario_id: $model->user->id,
            );
        })->all();
    }
    public function save(Servico $servico): ?Servico
    {
        $model = EloquentServico::create([
            'nome_servico' => $servico->nome_servico,
            'categoria' => $servico?->categoria?->id,
            'desc_servico' => $servico->desc_servico,
            'caminho_img' => $servico->caminho_img,
        ]);

        $categoria = new Categoria($model->categoria?->id, $model->categoria?->categoria);
        return $model ? new Servico($model->id, $model->nome_servico, $categoria, $model->desc_servico, $model->caminho_img, $model->user->id) : null;
    }
    public function findServicoByNomeAndUser(int $idUser, string $nomeServico): ?Servico
    {
        $model = EloquentServico::where('usuario_id', $idUser)
            ->whereRaw('LOWER(nome_servico) = ?', [strtolower($nomeServico)])
            ->with('categoria')
            ->first();

        if (!$model) {
            return null;
        }

        $categoria = new Categoria(
            id: $model->categoria->id,
            categoria: $model->categoria->categoria
        );

        return new Servico(
            id: $model->id,
            nome_servico: $model->nome_servico,
            categoria: $categoria,
            desc_servico: $model->desc_servico,
            caminho_img: $model->caminho_img,
            usuario_id: $model->user->id,
        );
    }
}
