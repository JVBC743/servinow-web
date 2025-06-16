<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Servico;

interface ServicoRepositoryInterface{

    public function findById(int $id): ?Servico;

}