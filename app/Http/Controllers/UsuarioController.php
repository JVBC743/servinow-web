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
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        $data = $request->validated();

        $editarUsuario = $useCase->execute($id,$data);

        if(!$editarUsuario){

            return redirect()->back()->with('error', 'Erro ao carregar dados do usuário para edição.');
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
