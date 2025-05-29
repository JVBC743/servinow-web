<?php

namespace App\Application\DTOs;

class ListUsersDTO{
    public function __construct(
        public $id,
        public $nome,
        public $email,
        public $telefone,
        public $cpf_cnpj,
        public $atuacao
    ){


    }

}
