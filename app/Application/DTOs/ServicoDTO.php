<?php

namespace App\Application\DTOs;

use App\Domain\Entities\Categoria;
use App\Domain\Entities\Usuario;

class ServicoDTO {
    public function __construct(
        public int $id,
        public string $nome_servico,
        public Categoria $categoria,
        public string $desc_servico,
        public string $caminho_img,
        public int $idUsuario,
    ) {}
}
