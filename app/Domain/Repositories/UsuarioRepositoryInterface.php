<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Usuario;

interface UsuarioRepositoryInterface {
    public function findById(int $id): ?Usuario;
    public function save(Usuario $user): void;
    public function delete(int $id): bool;
    public function listarUsuarios (): array;
    public function editarUsuario(int $id, array $data);
}
