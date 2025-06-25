<?php

namespace App\Domain\Repositories;

// Corrigido para usar o seu Model Eloquent 'Usuario', que representa o usuário no banco de dados.
use App\Models\Usuario;

interface UserRepositoryInterface {
    
    /**
     * Cria um novo usuário no repositório.
     * Este método vem da recomendação para o seu formulário de cadastro.
     *
     * @param array $data Os dados do usuário.
     * @return Usuario O usuário criado.
     */
    public function create(array $data): Usuario;

    /**
     * Encontra um usuário pelo seu ID.
     * Este método já estava no seu código.
     *
     * @param int $id
     * @return Usuario|null
     */
    public function findById(int $id): ?Usuario;
    
    /**
     * Salva (cria ou atualiza) um usuário.
     * Este método também já estava no seu código.
     *
     * @param Usuario $user
     * @return void
     */
    public function save(Usuario $user): void;
}
