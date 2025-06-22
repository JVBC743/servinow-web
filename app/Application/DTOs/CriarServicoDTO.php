<?php

namespace App\Application\DTOs;

class CriarServicoDTO {
    public function __construct(
        public int $id,
        public string $nome_servico,
        public $categoria,
        public string $desc_servico,
        public string $caminho_img,
    ) {}
}
