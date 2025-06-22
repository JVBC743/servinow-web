<?php

namespace App\Application\UseCases;
use App\Model\Usuario;
use App\Model\Formacao;
use App\Domain\Repositories\UsuarioRepositoryInterface as UsrRepo;

class AdminUsuarioEditUseCase{
    public function __construct(
        private UsrRepo $usrRepo
    )
    {}

    public function execute(int $id, array $data){
        $usuario = $this->usrRepo->editarUsuario($id, $data);
        return $usuario;
    }
}