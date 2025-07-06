<?php

namespace App\Http\Controllers;

use App\Application\DTOs\CreateUserDTO;
use App\Application\DTOs\RegisterUsuarioDTO;

use Illuminate\Http\JsonResponse;

use App\Models\Usuario;
use App\Models\Formacao;

use App\Domain\Repositories\UsuarioRepositoryInterface as UsrRepo;

use App\Http\Requests\RegisterUsuarioRequest;
use App\Http\Requests\EditarUsuarioRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{

    public function index()
    {
        $lista = Usuario::all();
        return view('pages.admin-lista-usuarios', compact('lista'));
    }

    public function adminListFormations($id)
    {
        $lista = Formacao::all();

        $editarUsuario = Usuario::find($id);

        if (!$editarUsuario) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        return redirect()->back()->with('success', 'O usuário foi editado com sucesso.');
    }

    public function listFormations($id)
    {
        $lista = Formacao::all();

        $editarUsuario = Usuario::find($id);

        if (!$editarUsuario) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }
        return view('pages.edicao-perfil', compact('lista', 'editarUsuario'));
    }

    public function show($id)
    { //método para passar o id do usuário pela URL para simular um login. Se quiser tirar para implementar o login, pode tirar

        $editarUsuario = Usuario::find($id);

        if (!$editarUsuario) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }
        $obj_formacao = Formacao::find($editarUsuario->area_atuacao); //Você só tem que arrumar um jeito de implementar isso sem o método "show".
        $editarUsuario->area_atuacao = $obj_formacao->formacao;

        return view("pages.edicao-perfil", compact('editarUsuario'));
    }

    public function adminShowUserAccount($id)
    {
        
        $editarUsuario = Usuario::find($id);

        $lista = Formacao::all();

        if (!$editarUsuario) {
             return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        $obj_formacao = Formacao::find($editarUsuario->area_atuacao);

        if($editarUsuario->caminho_img){
            $editarUsuario->imagem_bucket = Storage::disk('minio')->temporaryUrl($editarUsuario->caminho_img, Carbon::now()->addMinutes(5));
        }

        // $editarUsuario->area_atuacao = $obj_formacao->formacao;

        return view("pages.admin-edicao-perfil", compact('lista', 'editarUsuario'));
    }

    public function adminUsuarioEdit(EditarUsuarioRequest $request, int $id)
    {
        $usr = Usuario::find($id);
        
        if (!$usr) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }
        $data = $request->validated();
        
        if ($request->file('foto')) {
            
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();

            $path = Storage::disk('minio')->put('usuarios/' . $filename, file_get_contents($request->file('foto')));
            dd($path);
            // Storage::disk('s3')->put('imagens/foto_usuario_123.jpg', file_get_contents($request->file('imagem')));

            $data['caminho_img'] = $path;
        }

        $editarUsuario = $usr->update($data);
        // dd($editarUsuario);

        if (!$editarUsuario) {
            return redirect()->back()->with('error', 'Erro ao carregar dados do usuário para edição.');
        }

        return redirect()->back()->with('success', 'Usuário editado com sucesso!');
    }




    public function edit(EditarUsuarioRequest $request, int $id)
    {

        $usr = Usuario::find($id);
        if (!$usr) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        $data = $request->validated();
        $editarUsuario = $usr->update($data);

        if (!$editarUsuario){
            return redirect()->back()->with('error', 'Não foi possível editar o usuário.');
        }

        return view('pages.edicao-perfil', compact('editarUsuario'));
    }

    public function store(RegisterUsuarioRequest $request, RegisterUsuarioUseCase $useCase): JsonResponse
    {
        $dto = new RegisterUsuarioDTO(
            nome: $request->input('nome'),
            email: $request->input('email'),
            senha: $request->input('senha'),
            telefone: $request->input('telefone'),
            cpf_cnpj: $request->input('cpf_cnpj'),
            area_atuacao_id: (int) $request->input('area_atuacao_id')
        );

        $usuario = $useCase->execute($dto);

        return response()->json([
            'message' => 'Usuário criado com sucesso',
            'usuario' => [
                'id' => $usuario->id,
                'nome' => $usuario->nome,
                'email' => $usuario->email,
                'telefone' => $usuario->telefone,
                'cpf_cnpj' => $usuario->cpf_cnpj,
                'area_atuacao' => $usuario->area_atuacao->id,
            ],
        ], 201);
    }

    public function destroy($id) {}

    public function adminUserDestroy(int $id)
    {
        $usr = Usuario::find($id);

        if(!$usr){
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        $usr->destroy($id);

        return redirect()->back()->with('success','Usuário excluído com sucesso!');
    }

    public function showMinioTest()
    {
        $error = session('error');
        $success = session('success');
        // dd(Storage::disk('minio')->exists('algum-arquivo.txt'));
        return view('view-minio', compact('error', 'success'));
    }
    public function testeMinio(Request $request)
    {
        if ($request->hasFile('arquivo')) {
            $file = $request->file('arquivo');

            $path = Storage::disk('minio')->put('uploads', $file);
            return redirect()->back()->with('success', 'O arquivo foi armazenado com sucesso.');
        }
        return redirect()->back()->with('error', 'houve alguma falha.');
    }
}