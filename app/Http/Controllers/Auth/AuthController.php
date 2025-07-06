<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function register(UserRegisterRequest $request)
    {
        $usuario = Usuario::create([
            'nome' => $request->nome,
            'senha' => Hash::make($request->password),
            'telefone' => $request->telefone,
            'email' => $request->email,
            'cpf_cnpj' => $request->cpf_cnpj,
            // 'area_atuacao' => $request->area_atuacao,

            'data_nascimento' => $request->data_nascimento,
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf,

            'descricao' => $request->descricao,
            'caminho_img' => $request->caminho_img,
            'rede_social1' => $request->rede_social1,
            'rede_social2' => $request->rede_social2,
            'rede_social3' => $request->rede_social3,
            'rede_social4' => $request->rede_social4,
        ]);


        Auth::login($usuario);

        return redirect()->intended('dashboard');
    }
}
