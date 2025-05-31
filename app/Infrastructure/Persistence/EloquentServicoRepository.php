<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Servico;
use App\Domain\Entities\Categoria;
use App\Domain\Repositories\ServicoRepositoryInterface;
use App\Models\Servico as EloquentServico;

class EloquentServicoRepository implements ServicoRepositoryInterface
{
    public function getAll(): array
    {
        $models = EloquentServico::with('categoria')->get();

        return $models->map(function($model) {
            $categoria = new Categoria(
                id: $model->categoria->id,
                categoria: $model->categoria->categoria
            );

            return new Servico(
                id: $model->id,
                nome_servico: $model->nome_servico,
                categoria: $categoria,
                desc_servico: $model->desc_servico,
                caminho_img: $model->caminho_img
            );
        })->all();
    }
}
