<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Formacao;
use App\Domain\Repositories\FormacaoRepositoryInterface;
use App\Models\Formacao as EloquentFormacao;

class FormacaoRepository implements FormacaoRepositoryInterface
{
    public function findById(int $id): ?Formacao
    {
        $eloquentFormacao = EloquentFormacao::find($id);

        if (!$eloquentFormacao) {
            return null;
        }

        return new Formacao(
            $eloquentFormacao->id,
            $eloquentFormacao->descricao
        );
    }
}
