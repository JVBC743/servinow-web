<?php

namespace App\Domain\Entities;

use DateTime;

class Pagamento {
    public function __construct(
        public int $id,
        public Agendamento $agendamento,
        public StatusPagamento $status,
        public DateTime $data_pagamento,
        public MetodoPagamento $metodo,
    ) {}
}
