<?php

namespace App\Application\UseCases;

use App\Application\Interfaces\AuthServiceInterface;
use Illuminate\Auth\AuthenticationException;

class LoginUseCase
{
    public function __construct(
        private AuthServiceInterface $authService
    ) {}

    public function execute(array $credentials)
    {
        if (!$this->authService->attempt($credentials)) {
            throw new AuthenticationException('Credenciais inválidas');
        }

        return $this->authService->user();
    }
}
