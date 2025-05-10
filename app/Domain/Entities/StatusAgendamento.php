<?php

namespace App\Domain\Entities;

class StatusAgendamento {
    public function __construct(
        public int $id,
        public string $status,
    ) {}
}
