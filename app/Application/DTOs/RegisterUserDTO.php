<?php

namespace App\Application\DTOs;

class RegisterUsuarioDTO
{
    public function __construct(
        public string $nome,
        public string $senha,
        public string $telefone,
        public string $email,
        public string $cpf_cnpj,
        public int $area_atuacao_id
    ) {}
}
