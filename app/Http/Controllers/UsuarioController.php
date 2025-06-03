<?php

namespace App\Http\Controllers;

use App\Application\DTOs\CreateUserDTO;
use App\Application\UseCases\CreateUserUseCase;
use Illuminate\Http\Request;
use App\Application\UseCases\ListarUsuarioUseCase;
use App\Application\UseCases\EditarUsuarioUseCase;

class UsuarioController extends Controller {

    public function index(ListarUsuarioUseCase $listaUsuarios){
        $lista = $listaUsuarios->execute();
        return view('pages.lista-usuarios', compact('lista'));
    }

    public function edit(Request $request, EditarUsuarioUseCase $useCase, int $id){

        $usr = Usuario::find($id);
        if(!$usr){
            // logica para mandar uma msg de erro de volta para a view de edição de perfil
        }

        $data = $request->validated();

        $editarUsuario = $useCase->execute($id,$data);

        if(!$editarUsuario){

            //Lógica para retornar uma msg de erro.
            
        }

        return view('pages.edicao-perfil', compact('editarUsuario'));

    }






    public function store(Request $request, CreateUserUseCase $useCase) {
        $dto = new CreateUserDTO(
            name: $request->input('name'),
            email: $request->input('email')
        );

        $useCase->execute($dto);

        return response()->json(['message' => 'Usuário criado']);
    }
}
