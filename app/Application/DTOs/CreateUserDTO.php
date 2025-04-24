<?php

namespace App\Application\DTOs;

class CreateUserDTO {
    public function __construct(
        public string $name,
        public string $email
    ) {}
}
