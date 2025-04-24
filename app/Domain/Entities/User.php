<?php

namespace App\Domain\Entities;

class User {
    public function __construct(
        public string $name,
        public string $email
    ) {}
}
