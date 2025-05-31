<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\Repositories\FormacaoRepositoryInterface;
use App\Application\Interfaces\HashProviderInterface;
use App\Application\DTOs\RegisterUsuarioDTO;
use App\Domain\Entities\Usuario;

class RegisterUsuarioUseCase
{
    public function __construct(
        private UserRepositoryInterface $usuarioRepository,
        private FormacaoRepositoryInterface $formacaoRepository,
        private HashProviderInterface $hashProvider
    ) {}

    public function execute(RegisterUsuarioDTO $data): Usuario
    {
        $existingUsuario = $this->usuarioRepository->findByEmail($data->email);

        if ($existingUsuario) {
            throw new \Exception('Usuário já existe');
        }

        $formacao = $this->formacaoRepository->findById($data->area_atuacao_id);

        if (!$formacao) {
            throw new \Exception('Formação não encontrada');
        }

        $hashedSenha = $this->hashProvider->make($data->senha);

        $usuario = new Usuario(
            0,
            $data->nome,
            $hashedSenha,
            $data->telefone,
            $data->email,
            $data->cpf_cnpj,
            $formacao
        );

        return $this->usuarioRepository->save($usuario);
    }
}
