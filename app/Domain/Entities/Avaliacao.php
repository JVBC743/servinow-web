<?php

namespace App\Domain\Entities;

use DateTime;

class Avaliacao {
    public function __construct(
        public int $id,
        public Usuario $cliente,
        public Servico $servico,
        public DateTime $data_avaliacao,
        public int $nota, //enum no banco de dados
        public String $comentario
    ) {}
}
