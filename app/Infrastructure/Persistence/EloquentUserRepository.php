<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Models\User as EloquentUser;

class EloquentUserRepository implements UserRepositoryInterface {
    public function findById(int $id): ?User {
        $model = EloquentUser::find($id);
        return $model ? new User($model->name, $model->email) : null;
    }

    public function save(User $user): void {
        EloquentUser::create([
            'name' => $user->name,
            'email' => $user->email
        ]);
    }
}
