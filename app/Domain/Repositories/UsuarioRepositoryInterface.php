<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;

interface UsuarioRepositoryInterface {
    public function findById(int $id): ?User;
    public function save(Usuario $user): void;
    public function listarUsuarios (): array;
}
