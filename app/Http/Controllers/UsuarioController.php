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

        if (auth()->id() !== (int) $id && !auth()->user()->is_admin) {
            abort(403, 'Acesso não autorizado.');
        }
        $usr = Usuario::find($id);

        $lista = Formacao::all();

        if ($usr->caminho_img) {
            $imagem_url = Storage::disk('miniobusca')->temporaryUrl(
                $usr->caminho_img,
                now()->addMinute(5)
            );
        } else {
            $imagem_url = null;
        }

        if (!$usr) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        return view("pages.edicao-perfil", compact('usr', 'lista', 'imagem_url'));
    }

    public function edit(EditarUsuarioRequest $request, int $id)
    {

        if (auth()->id() !== (int) $id && !auth()->user()->is_admin) {
            abort(403, 'Acesso não autorizado.');
        }
        $usr = Usuario::find($id);

        if (!$usr) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        $data = $request->validated();
        if ($request->hasFile('foto')) {
            if ($usr->caminho_img) {
                // Apaga imagem antiga
                Storage::disk('minio')->delete($usr->caminho_img);
            }

            $path = $request->file('foto')->store('imagens/usuario', 'minio');
            $data["caminho_img"] = $path;
        }

        if ($usr->update($data)) {
            return redirect()
                ->route('mostrar.edicao', ['id' => $id])
                ->with('success', 'Perfil atualizado com sucesso!');
        }

        return redirect()
            ->back()
            ->with('error', 'Falha ao salvar!');
    }

    public function adminShowUserAccount($id)
    {

        $editarUsuario = Usuario::find($id);

        $lista = Formacao::all();

        if (!$editarUsuario) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        // $obj_formacao = Formacao::find($editarUsuario->area_atuacao);

        if ($editarUsuario->caminho_img) {
            $imagem_url = Storage::disk('miniobusca')->temporaryUrl(
                $editarUsuario->caminho_img,
                now()->addMinutes(5)
            );
        } else {
            $imagem_url = null;
        }
        // dd($imagem_url);
        return view("pages.admin-edicao-perfil", compact('lista', 'editarUsuario', 'imagem_url'));
    }

    public function adminUsuarioEdit(EditarUsuarioRequest $request, int $id)
    {
        $usr = Usuario::find($id);

        if (!$usr) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }
        $data = $request->validated();

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            // Deleta imagem antiga
            if ($usr->caminho_img) {
                Storage::disk('minio')->delete($usr->caminho_img);
            }

            // Upload da nova imagem
            $path = $request->file('foto')->store('usuarios', 'minio');
            $data['caminho_img'] = $path;
        }

        if ($usr->update($data)) {
            return redirect()
                ->route('admin.mostrar.edicao', ['id' => $id])
                ->with('success', 'Usuário editado com sucesso!');
        }

        return redirect()
            ->back()
            ->with('error', 'Falha ao salvar!');
    }

    public function destroy($id) {}

    public function adminUserDestroy(int $id)
    {
        $usr = Usuario::find($id);

        if (!$usr) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        $usr->destroy($id);

        return redirect()->back()->with('success', 'Usuário excluído com sucesso!');
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
