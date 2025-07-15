<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Usuario; // ajuste se o nome for diferente
use App\Services\EvolutionWhatsApp;

class RecuperacaoSenhaController extends Controller
{
    /**
     * Exibe o formulário de solicitação de recuperação de senha.
     */
    public function mostrarFormularioSolicitacao()
    {
        return view('pages.recuperacao-senha');
    }

    /**
     * Processa o pedido de recuperação e envia o link via WhatsApp.
     */
    public function enviarLinkRecuperacao(Request $request)
    {
        $request->validate([
            'telefone' => 'required|string|max:50',
        ]);

        $telefone = preg_replace('/[^0-9]/', '', $request->telefone); // Sanitiza o telefone
        $usuario = Usuario::where('telefone', $telefone)->first();

        if (!$usuario) {
            return back()->withErrors(['telefone' => 'Telefone não encontrado.']);
        }

        // Gera e salva o token
        $token = Str::random(60);
        DB::table('password_resets')->where('telefone', $telefone)->delete();
        DB::table('password_resets')->insert([
            'telefone' => $telefone,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        // Link de recuperação
        $link = url("/recuperar-senha/redefinir/{$token}?telefone={$telefone}");

        try {
            $resposta = EvolutionWhatsApp::sendMessage(
                'ServiNow',
                $telefone,
                "Olá! Recebemos uma solicitação para redefinir a senha da sua conta no ServiNow. Para prosseguir, clique no link abaixo:\n\n{$link}\n\nSe você não solicitou essa recuperação, ignore esta mensagem."
            );
        } catch (\Throwable $e) {
            // Opcional: log do erro
            \Log::error("Erro ao enviar mensagem de recuperação: " . $e->getMessage());

            return back()->withErrors(['telefone' => 'Erro ao enviar a mensagem de recuperação. Tente novamente.']);
        }

        return back()->with('status', 'Link de recuperação enviado via WhatsApp!');
    }


    /**
     * Exibe o formulário de redefinição de senha com base no token.
     */
    public function mostrarFormularioRedefinicao($token, Request $request)
    {
        $telefone = $request->query('telefone');

        if (!$telefone) {
            return redirect()->route('recuperacao.senha')->withErrors(['telefone' => 'Telefone não informado no link.']);
        }

        return view('pages.redefinir-senha', [
            'token' => $token,
            'telefone' => $telefone
        ]);
    }


    /**
     * Processa a nova senha.
     */
    public function redefinirSenha(Request $request)
    {
        $request->validate([
            'telefone' => 'required|string|max:50',
            'token' => 'required|string',
            'password' => 'required|confirmed|min:6',
        ]);

        $telefone = preg_replace('/[^0-9]/', '', $request->telefone);

        $registro = DB::table('password_resets')
            ->where('telefone', $telefone)
            ->where('token', $request->token)
            ->first();

        if (!$registro || Carbon::parse($registro->created_at)->addMinutes(60)->isPast()) {
            return back()->withErrors(['token' => 'Token inválido ou expirado.']);
        }

        $usuario = Usuario::where('telefone', $telefone)->first();
        if (!$usuario) {
            return back()->withErrors(['telefone' => 'Usuário não encontrado.']);
        }

        // Atualiza a senha
        $usuario->senha = Hash::make($request->password);
        $usuario->save();

        // Remove o token usado
        DB::table('password_resets')->where('telefone', $telefone)->delete();

        return redirect()->route('login')->with('status', 'Senha redefinida com sucesso!');
    }
}
