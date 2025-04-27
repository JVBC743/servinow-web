<?php

namespace App\Domain\Entities;

class Formacao {
    public function __construct(
        public int $id,
        public string $formacao,
    ) {}
}
