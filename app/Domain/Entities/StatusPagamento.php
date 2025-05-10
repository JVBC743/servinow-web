<?php

namespace App\Domain\Entities;

class StatusPagamento {
    public function __construct(
        public int $id,
        public string $status,
    ) {}
}
