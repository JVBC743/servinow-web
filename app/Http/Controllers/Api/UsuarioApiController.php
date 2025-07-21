<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Formacao;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\EditarUsuarioRequest;

class UsuarioApiController extends Controller
{
    public function show($id)
    {
        if (auth()->id() !== (int) $id && !auth()->user()->is_admin) {
            return response()->json(['error' => 'Acesso não autorizado.'], 403);
        }
        $usr = Usuario::with('formacao')->find($id);

        if (!$usr) {
            return response()->json(['error' => 'Usuário não encontrado.'], 404);
        }

        $lista = Formacao::all();

        if ($usr->caminho_img) {
            $imagem_url = Storage::disk('miniobusca')->temporaryUrl(
                $usr->caminho_img,
                now()->addMinute(5)
            );
        } else {
            $imagem_url = null;
        }

        return response()->json([
            'usuario' => $usr,
            'formacoes' => $lista,
            'imagem_url' => $imagem_url
        ]);
    }

    public function edit(EditarUsuarioRequest $request, int $id)
    {
        if (auth()->id() !== (int) $id && !auth()->user()->is_admin) {
            return response()->json(['error' => 'Acesso não autorizado.'], 403);
        }
        $usr = Usuario::find($id);

        if (!$usr) {
            return response()->json(['error' => 'Usuário não encontrado.'], 404);
        }

        $data = $request->validated();
        if ($request->hasFile('foto')) {
            if ($usr->caminho_img) {
                Storage::disk('minio')->delete($usr->caminho_img);
            }
            $path = $request->file('foto')->store('imagens/usuario', 'minio');
            $data["caminho_img"] = $path;
        }

        if ($usr->update($data)) {
            return response()->json(['success' => 'As alterações foram aplicadas com sucesso!', 'usuario' => $usr]);
        }

        return response()->json(['error' => 'Falha ao atualizar usuário.'], 500);
    }
}
