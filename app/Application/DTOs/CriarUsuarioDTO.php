<?php

namespace App\Application\DTOs;

class CriarUsuarioDTO {
    public function __construct(
        public string $name,
        public string $email
    ) {}
}
