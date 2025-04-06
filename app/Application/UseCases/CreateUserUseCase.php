<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Application\DTOs\CreateUserDTO;
use App\Domain\Entities\User;

class CreateUserUseCase {
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(CreateUserDTO $data): void {
        $user = new User($data->name, $data->email);
        $this->userRepository->save($user);
    }
}
