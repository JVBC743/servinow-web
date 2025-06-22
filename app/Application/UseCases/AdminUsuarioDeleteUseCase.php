<?php

namespace App\Application\UseCases;
use App\Model\Usuario;
use App\Model\Formacao;
use App\Domain\Repositories\UsuarioRepositoryInterface as UsrRepo;

class AdminUsuarioDeleteUseCase{
    public function __construct(
        private UsrRepo $usrRepo
    )
    {}

    public function execute(int $id): bool
    {

        $usuario = $this->usrRepo->findById($id);

        return $this->usrRepo->delete($id);
        
    }
}