<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\User\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        // Aqui usamos o Model do Eloquent para criar o usuário
        return User::create($data);
    }
}
