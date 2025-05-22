<?php

namespace App\Domain\Entities;

class Usuario {
    public function __construct(
        public int $id,
        public string $nome,
        public string $senha,
        public string $telefone,
        public string $email,
        public string $cpf_cnpj,
        public Formacao $area_atuacao,
    ) {}
}
