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

            if (Auth::user()->bloqueado) {

                Auth::logout();

                return redirect()->route('login')->withErrors([
                    'email' => 'Sua conta está bloqueada. Entre em contato com o suporte.',
                ]);
            }

            $request->session()->regenerate();
            return redirect()->route('dashboard');
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

        $usuariosExistentes = Usuario::all();
        foreach($usuariosExistentes as $usr){
            if($request->telefone == $usr->telefone){
                
                return redirect()->back()->with('error', 'O telefone ' . $usr->telefone . ' já existe. Insira outro.');

            }
        }
        

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

        Auth::login($usuario);

        return redirect()->route('dashboard');
    }
}
