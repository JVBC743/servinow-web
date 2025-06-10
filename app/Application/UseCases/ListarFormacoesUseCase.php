<?php

namespace App\Application\UseCases;
use App\Model\Formacao;
use App\Domain\Repositories\UsuarioRepositoryInterface as UsrRepo;

class ListarFormacoesUseCase{

    public function __construct(
        private UsrRepo $usrRepo
    ){}

    public function execute(): array{
       
        $listaFormacoes = $this->usrRepo->listarFormacoes();

        return $listaFormacoes;
    }
}