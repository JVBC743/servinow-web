<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Servico;

interface ServicoRepositoryInterface
{
    /**
     * @return Servico[]
     */
    public function getAll(): array;
    /**
     * @return Servico
     */
    public function save(Servico $servico): ?Servico;
    /**
     * @return Servico|null
     */
    public function findServicoByNomeAndUser(int $idUser, String $nomeServico): ?Servico;
}
