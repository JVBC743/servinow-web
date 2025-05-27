<?php

namespace App\Domain\Entities;

class MetodoPagamento {
    public function __construct(
        public int $id,
        public string $metodo,
    ) {}
}
