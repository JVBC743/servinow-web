<?php

namespace App\Application\UseCases;
use App\Application\DTOs\ListarUsuarioDTO;
use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UsuarioRepositoryInterface as UsrRepo;

    class EditarUsuarioUseCase{
        public function __construct(
            private UsrRepo $usrRepo
        )
        {}
        public function execute(int $id, array $data){

            return $this->usrRepo->editarUsuario($id, $data);

        }
    }