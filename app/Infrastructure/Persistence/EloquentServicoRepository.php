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
}
