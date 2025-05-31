<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Usuario;

interface UserRepositoryInterface {
    public function findById(int $id): ?Usuario;
    public function save(Usuario $user): Usuario;
    public function findByEmail(String $email): ?Usuario;
}
