<?php

namespace App\Application\UseCases;
use App\Application\DTOs\ListUsersDTO;
use App\Domain\Entities\Usuario;

class ListUserUseCase{

    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}
    public function execute(ListUsersDTO $data): void{
        $user = New Usuario(
            $data->id, 
            $data->nome, 
            $data->email, 
            $data->telefone, 
            $data->cpf_cnpj,
            $data->atuacao
        );
    }
}
