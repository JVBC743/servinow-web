<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\ServicoRepositoryInterface;
use App\Application\DTOs\CriarServicoDTO;
use App\Domain\Entities\Servico;

class CriarServicoUseCase {
    public function __construct(
        private ServicoRepositoryInterface $servRepo
    )
    {}

    public function execute(CriarServicoDTO $data): void
    {
        $servico = new Servico(
            $data->nome,
            $data->id,
            $data->nome_servico,
            $data->categoria,
            $data->desc_servico,
            $data->caminho_img,
        );
        $this->servicoRepo->save($servico);
    }
}