<?php

namespace App\Application\UseCases;
use App\Application\DTOs\ListarUsuarioDTO;
use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UsuarioRepositoryInterface as UsrRepo;

class ListarUsuarioUseCase{

    public function __construct(
        private UsrRepo $usrRepo
    ) {}
    public function execute(): array{
        // aplicar lógica aqui

        return $listaUsuarios = $this->usrRepo->listarUsuarios();

    }
}
