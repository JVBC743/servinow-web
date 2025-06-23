<?php

namespace App\Application\UseCases;

use App\Application\DTOs\ServicoDTO;
use App\Application\Interfaces\StorageServiceInterface;
use App\Domain\Entities\Servico;
use App\Domain\Repositories\ServicoRepositoryInterface;
use Exception;

class CreateServicoUseCase
{
    public function __construct(
        private ServicoRepositoryInterface $servicoRepository,
        private StorageServiceInterface $storageService
    ) {}

    public function execute(ServicoDTO $data): Servico
    {
        $existingService = $this->servicoRepository->findServicoByNomeAndUser($data->idUsuario, $data->nome_servico);
        if($existingService) {
            throw new Exception("Nome de serviço já está em uso!");
        }

        $servico = new Servico(
            0,
            $data->nome_servico,
            $data->categoria,
            $data->desc_servico,
            $data->caminho_img,
        );

        return $this->servicoRepository->save($servico);
    }
}
