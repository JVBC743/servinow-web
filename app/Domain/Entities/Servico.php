<?php

namespace App\Domain\Entities;

class Servico {
    public function __construct(
        public int $id,
        public string $nome_servico,
        public Categoria $categoria,
        public string $desc_servico,
        public string $caminho_img,
        public int $usuario_id,
    ) {}
}
