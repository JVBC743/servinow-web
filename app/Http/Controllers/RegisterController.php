namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('cadastro'); // Retorna a view 'cadastro'
    }

    public function register(Request $request)
    {
        // Validação e lógica de cadastro aqui
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            // Adicione outras validações conforme necessário
        ]);

        // Lógica para salvar no banco (exemplo com User model)
        // User::create([...]);

        return redirect()->route('register')->with('success', 'Cadastro realizado com sucesso!');
    }
}
