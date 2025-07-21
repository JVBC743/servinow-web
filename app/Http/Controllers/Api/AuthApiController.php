<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Usuario;
use App\Services\EvolutionWhatsApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;


class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if($usuario && $usuario->bloqueado) {
            throw ValidationException::withMessages([
                'email' => ['Sua conta está bloqueada. Entre em contato com o suporte.'],
            ]);
        }

        if (! $usuario || ! Hash::check($request->password, $usuario->senha)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais estão incorretas.'],
            ]);
        }

        $token = $usuario->createToken('api_token')->plainTextToken;

        return response()->json([
            'usuario' => $usuario,
            'token'   => $token,
        ]);
    }

    public function register(UserRegisterRequest $request)
    {
        $usuario = Usuario::create([
            'nome' => $request->nome,
            'senha' => Hash::make($request->password),
            'telefone' => $request->telefone,
            'email' => $request->email,
            'cpf_cnpj' => $request->cpf_cnpj,
            'data_nascimento' => $request->data_nascimento,
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
        ]);

        $token = $usuario->createToken('api_token')->plainTextToken;

        return response()->json([
            'usuario' => $usuario,
            'token' => $token,
        ], 201);
    }

    public function enviarLinkRecuperacao(Request $request)
    {
        $request->validate([
            'telefone' => 'required|string|max:50',
        ]);

        $telefone = preg_replace('/[^0-9]/', '', $request->telefone);
        $usuario = Usuario::where('telefone', $telefone)->first();

        if (!$usuario) {
            return response()->json(['error' => 'Telefone não encontrado.'], 404);
        }

        $token = Str::random(60);
        DB::table('password_resets')->where('telefone', $telefone)->delete();
        DB::table('password_resets')->insert([
            'telefone' => $telefone,
            'token' => $token,
            'created_at' => \Carbon\Carbon::now(),
        ]);

        $link = url("/recuperar-senha/redefinir/{$token}?telefone={$telefone}");

        try {
            $resposta = EvolutionWhatsApp::sendMessage(
                'ServiNow',
                $telefone,
                "Olá! Recebemos uma solicitação para redefinir a senha da sua conta no ServiNow. Para prosseguir, clique no link abaixo:\n\n{$link}\n\nSe você não solicitou essa recuperação, ignore esta mensagem."
            );
        } catch (\Throwable $e) {
            \Log::error("Erro ao enviar mensagem de recuperação: " . $e->getMessage());
            return response()->json(['error' => 'Erro ao enviar a mensagem de recuperação. Tente novamente.'], 500);
        }

        return response()->json(['message' => 'Link de recuperação enviado via WhatsApp!']);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
