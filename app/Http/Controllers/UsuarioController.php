<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\JsonResponse;

use App\Models\Usuario;
use App\Models\Formacao;

use App\Http\Requests\EditarUsuarioRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

use App\Services\EvolutionWhatsApp;

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

        $usr = Usuario::find($id);

        if (!$usr) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        return redirect()->back()->with('success', 'O usuário foi editado com sucesso.');
    }


    public function showPerfil()
    {
        $id = Auth::id();
        $usr = Usuario::find($id);

        if ($usr->caminho_img) {
            $imagem_url = Storage::disk('miniobusca')->temporaryUrl($usr->caminho_img, now()->addMinutes(5));
        } else {
            $imagem_url = null;
        }

        $lista = Formacao::all();

        return view('pages.visualizacao-perfil-usuario', compact('usr', 'lista', 'imagem_url'));
    }

    public function listFormations($id)
    {
        $lista = Formacao::all();



        return view('pages.edicao-perfil', compact('lista'));
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
                ->back()
                ->with('success', 'As alterações foram aplicadas com sucesso!');
        }

        return redirect()
            ->back()
            ->with('error', 'Falha ao salvar!');
    }

    public function adminShowUserAccount($id)
    {

        $usr = Usuario::find($id);

        $lista = Formacao::all();

        if (!$usr) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        if ($usr->caminho_img) {
            $imagem_url = Storage::disk('miniobusca')->temporaryUrl(
                $usr->caminho_img,
                now()->addMinutes(5)
            );
        } else {

            $imagem_url = null;
        }
        // dd($imagem_url);
        return view("pages.admin-edicao-perfil", compact('lista', 'usr', 'imagem_url'));
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

    public function destroy($id)
    {
        $usr = Usuario::find($id);

        if (!$usr) {
            return redirect()->back()->with('error', 'O usuário selecionado para exclusão não foi encontrado.');
        }

        $usr->delete();
        return redirect()->route('dashboard.guest')->with('success', 'A sua conta foi excluída com sucesso.');
    }

    public function gerarRelatorio()
    {

    }

    public function adminUserDestroy(int $id)
    {
        $usr = Usuario::find($id);

        if (!$usr) {
            return redirect()->back()->with('error', 'O usuário selecionado para exclusão não foi encontrado.');
        }

        // $cliente = Auth::user();


        
        $dataFormatada = \Carbon\Carbon::parse($data['data'])->format('d/m/Y H:i');

        // Mensagem para o cliente
        $mensagemClientes = "Olá, *{$usr}*, a sua conta foi excluída por um administrador do sistema. Entre em contato com um dos e-mails dos desenvolvedores para mais detalhes: joaovictor.brumc@gmail.com, joseclaionmartins@gmail.com ou mateus4pantoja@gmail.com";
        EvolutionWhatsApp::sendMessage('ServiNow', $usr->telefone, $mensagemClientes);

        // Mensagem para o provedor/prestador
        // $mensagemPrestador = "Olá {$prestador->nome}, você recebeu uma nova solicitação de agendamento para o serviço *{$nomeServico}*.\n\n👤 Cliente: {$cliente->nome}\n📞 Contato: {$cliente->telefone}\n📅 Data: *{$dataFormatada}*\n💬 Descrição: {$data['descricao']}\n\nAcesse seu painel para aceitar ou recusar.";
        // EvolutionWhatsApp::sendMessage('ServiNow', $prestador->telefone, $mensagemPrestador);

        $usr->delete();

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
