<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Usuario as EntityUsuario;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Models\Usuario as ModelUsuario;
use App\Models\Formacao as ModelFormacao;
use App\Domain\Entities\Formacao as EntityFormacao;

class EloquentUsuarioRepository implements UsuarioRepositoryInterface {

    public function findById(int $id): ?EntityUsuario
    {
        $model = ModelUsuario::with('formacao')->find($id);
        if ($model) {
            $areaAtuacao = $model->formacao
                ? new EntityFormacao($model->formacao->id, $model->formacao->formacao)
                : new EntityFormacao(0, 'Sem formação');
            return new EntityUsuario(
                $model->id,
                $model->nome,
                $model->senha,
                $model->email,
                $model->telefone,
                $model->cpf_cnpj,
                $areaAtuacao,
                $model->rede_social1 ?? '',
                $model->rede_social2 ?? '',
                $model->rede_social3 ?? '',
                $model->rede_social4 ?? '',
            );
        }
        return null; //Encontrar uma forma mais fácil de passar a área de atuação
    }

    public function delete(int $id): bool
    {
        return (bool) ModelUsuario::destroy($id);
    }

    public function save(EntityUsuario $usuario): void {
        EloquentUsuario::create([
            'nome' => $usuario->nome,
            'email' => $usuario->email
        ]);
    }

    public function listarUsuarios(): array{

        return ModelUsuario::all()->map(fn($usuario) => [

            'id' => $usuario->id,
            'nome' => $usuario->nome,
            'email' => $usuario->email,
            'telefone' => $usuario->telefone,
            'cpf_cnpj' => $usuario->cpf_cnpj,
            'area_atuacao' => $usuario->area_atuacao,
            'rede_social1' => $usuario->rede_social1,
            'rede_social2' => $usuario->rede_social2,
            'rede_social3' => $usuario->rede_social3,
            'rede_social4' => $usuario->rede_social4,

        ])->toArray();
    }

    public function editarUsuario(int $id, array $data){

        $usuario = ModelUsuario::find($id);
        $atuacao = ModelFormacao::find($usuario->area_atuacao); //Retorna o id da área de atuação do prestador

        if($usuario && $usuario->update($data)){

            return [

                'usuario' => $usuario,
                'atuacao' => $atuacao,
            ];
        }
        return null;
    }

    public function listarFormacoes(){

        return ModelFormacao::all()->map(fn($formacoes) => [
            'id' => $formacoes->id,
            'formacao' => $formacoes->formacao

        ])->toArray();

    }
}
