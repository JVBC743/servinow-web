<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Models\Usuario as EloquentUsuario;

class EloquentUsuarioRepository implements UsuarioRepositoryInterface {
    public function findById(int $id): ?Usuario {
        $model = EloquentUsuario::find($id);
        return $model ? new Usuario($model->name, $model->email) : null;
    }

    public function save(Usuario $usuario): void {
        EloquentUsuario::create([
            'nome' => $usuario->nome,
            'email' => $usuario->email
        ]);
    }

    public function listarUsuarios(): array{

        return EloquentUsuario::all()->map(fn($usuario) => [

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

        $usuario = Usuario::find($id);        


        if($usuario && $usuario->update($data)){
            return $usuario;
        }
        return null;
    }
}
