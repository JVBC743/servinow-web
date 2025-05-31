<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\ServicoRepositoryInterface;
use App\Application\Interfaces\StorageServiceInterface;

class ListServicosUseCase
{
    public function __construct(
        private ServicoRepositoryInterface $servicoRepository,
        private StorageServiceInterface $storageService
    ) {}

    public function execute(): array
    {
        $servicos = $this->servicoRepository->getAll();

        return array_map(function($servico) {
            return [
                'id' => $servico->id,
                'nome_servico' => $servico->nome_servico,
                'categoria' => $servico->categoria->categoria,
                'desc_servico' => $servico->desc_servico,
                'imagem_url' => $this->storageService->getUrl($servico->caminho_img),
            ];
        }, $servicos);
    }
}

