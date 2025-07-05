<?php

namespace App\Domain\Services;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
// Supondo que seu UserValidator também esteja neste namespace
use App\Domain\Services\UserValidator; 

class CreateUserUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserValidator $userValidator // Injetando o validador
    ) {}

    /**
     * @throws \Illuminate\Validation\ValidationException se os dados forem inválidos
     */
    public function execute(array $data): Usuario
    {
        // 1. A primeira e única responsabilidade de validação é delegada.
        $this->userValidator->validate($data);

        // 2. Se a validação passou, a orquestração continua...
        // Regra de negócio: Criptografar a senha antes de salvar
        $data['password'] = Hash::make($data['password']);

        // 3. Delegar a persistência para o repositório.
        $user = $this->userRepository->create($data);

        return $user;
    }
}
