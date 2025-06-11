<?php

namespace App\Application\UseCases;
use App\Model\Usuario;
use App\Model\Formacao;
use App\Domain\Repositories\UsuarioRepositoryInterface as UsrRepo;

class EditarUsuarioUseCase{
    public function __construct(
        private UsrRepo $usrRepo
    )
    {}
    public function execute(int $id, array $data){

        $retorno = $this->usrRepo->editarUsuario($id, $data);
        
        $usuario = $retorno['usuario'];// obj do Usuario
        $atuacao = $retorno['atuacao'];// obj do Formacao

        return $usuario;
    }
}