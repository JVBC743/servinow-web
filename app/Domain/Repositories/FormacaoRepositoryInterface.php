<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Formacao;

interface FormacaoRepositoryInterface
{
    public function findById(int $id): ?Formacao;
}
