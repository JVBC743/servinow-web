<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Services\CreateUserUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Injeta a dependência do nosso caso de uso de criação de usuário.
     * O Laravel fará isso automaticamente para nós.
     */
    public function __construct(
        private readonly CreateUserUseCase $createUserUseCase
    ) {}

    /**
     * Lida com a requisição de POST do formulário de cadastro.
     */
    public function store(Request $request)
    {
        try {
            // Pega todos os dados do formulário (nome, email, cpf, etc.)
            $userData = $request->all();

            // Executa nosso caso de uso, passando os dados do formulário
            $user = $this->createUserUseCase->execute($userData);

            // Opcional: Loga o usuário recém-criado automaticamente
            // auth()->login($user);

            // Redireciona para o dashboard com uma mensagem de sucesso
            return redirect()->route('dashboard')->with('success', 'Cadastro realizado com sucesso!');

        } catch (ValidationException $e) {
            // Se a validação no nosso UserValidator falhar, ele lança esta exceção.
            // Redirecionamos de volta para o formulário, com os erros de validação e os dados que o usuário já preencheu.
            return back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            // Captura qualquer outro erro inesperado que possa acontecer.
            // Redireciona de volta com uma mensagem de erro genérica.
            return back()->with('error', 'Ocorreu um erro inesperado. Por favor, tente novamente.')->withInput();
        }
    }
}
