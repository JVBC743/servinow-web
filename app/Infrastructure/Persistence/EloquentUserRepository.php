<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Formacao;
use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Models\Usuario as EloquentUser;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function findById(int $id): ?Usuario
    {
        $model = EloquentUser::find($id);
        $formacao = new Formacao($model->formacao->id, $model->formacao->formacao);
        return $model ? new Usuario($model->id, $model->nome, "", $model->telefone, $model->email, $model->cpf_cnpj, $formacao) : null;
    }

    public function save(Usuario $user): Usuario
    {
        $model = EloquentUser::create([
            'name' => $user->nome,
            'email' => $user->email,
            'senha' => $user->senha,
            'telefone' => $user->telefone,
            'cpf_cnpj' => $user->cpf_cnpj,
            'area_atuacao' => $user->area_atuacao->id
        ]);

        $formacao = new Formacao($model->formacao?->id, $model->formacao?->formacao);
        return $model ? new Usuario($model->id, $model->nome, "", $model->telefone, $model->email, $model->cpf_cnpj, $formacao) : null;
    }

    public function findByEmail(string $email): ?Usuario
    {
        $model = EloquentUser::where('email', $email)->first();
        $formacao = new Formacao($model->formacao->id, $model->formacao->formacao);
        return $model ? new Usuario($model->id, $model->nome, "", $model->telefone, $model->email, $model->cpf_cnpj, $formacao) : null;
    }
}
