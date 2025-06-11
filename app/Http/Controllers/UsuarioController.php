<?php

namespace App\Http\Controllers;

use App\Application\DTOs\CreateUserDTO;
use App\Application\UseCases\CreateUserUseCase;
use Illuminate\Http\Request;
use App\Application\UseCases\ListarUsuarioUseCase;
use App\Application\UseCases\EditarUsuarioUseCase;
use App\Application\UseCases\ListarFormacoesUseCase;
use App\Models\Usuario;
use App\Models\Formacao;
use App\Http\Requests\EditarUsuarioRequest;
use App\Domain\Repositories\UsuarioRepositoryInterface as UsrRepo;

class UsuarioController extends Controller {

    public function index(ListarUsuarioUseCase $listaUsuarios){
        $lista = $listaUsuarios->execute();
        return view('pages.lista-usuarios', compact('lista'));
    }

    public function listFormations(ListarFormacoesUseCase $listaFormacoes, $id){

        $lista = $listaFormacoes->execute();

        $editarUsuario = Usuario::find($id);

        if (!$editarUsuario) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }
        return view ('pages.edicao-perfil', compact('lista', 'editarUsuario'));

    }

    public function show($id){ //método para passar o id do usuário pela URL para simular um login. Se quiser tirar para implementar o login, pode tirar

        $editarUsuario = Usuario::find($id);

        if(!$usr){
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }
        $obj_formacao = Formacao::find($editarUsuario->area_atuacao); //Você só tem que arrumar um jeito de implementar isso sem o método "show".
        $editarUsuario->area_atuacao = $obj_formacao->formacao;

        return view("pages.edicao-perfil", compact('editarUsuario'));
    }

    public function edit(EditarUsuarioRequest $request, EditarUsuarioUseCase $useCase,  int $id){

        $usr = Usuario::find($id);
        if(!$usr){
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        $lista = (new ListarFormacoesUseCase(app(UsrRepo::class)))->execute();

        $data = $request->validated();

        $editarUsuario = $useCase->execute($id,$data);

        if(!$editarUsuario){

            return redirect()->back()->with('error', 'Erro ao carregar dados do usuário para edição.');
        }

        return view('pages.edicao-perfil', compact('editarUsuario', 'lista'));

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
