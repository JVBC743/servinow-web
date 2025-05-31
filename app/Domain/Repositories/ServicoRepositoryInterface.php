<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Servico;

interface ServicoRepositoryInterface
{
    /**
     * @return Servico[]
     */
    public function getAll(): array;
}
