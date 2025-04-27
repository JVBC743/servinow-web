<?php

namespace App\Domain\Entities;

use DateTime;

class Agendamento {
    public function __construct(
        public int $id,
        public Usuario $cliente,
        public Servico $servico,
        public Usuario $prestador,
        public DateTime $data_agendamento,
        public StatusAgendamento $status,
        public string $notificacao,
    ) {}
}
