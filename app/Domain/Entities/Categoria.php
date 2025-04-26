<?php

namespace App\Domain\Entities;

class Categoria {
    public function __construct(
        public int $id,
        public string $categoria,
    ) {}
}
