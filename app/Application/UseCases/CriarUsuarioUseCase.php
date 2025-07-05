<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Application\DTOs\CreateUserDTO;
use App\Domain\Entities\Usuario;

class CriarUsuarioUseCase {
    public function __construct(
        private UsuarioRepositoryInterface $usuarioRepository
    ) {}

    public function execute(CriarUsuarioDTO $data): void {
        $usuario = new Usuario($data->nome, $data->email);
        $this->usuarioRepository->save($usuario);
    }
}
