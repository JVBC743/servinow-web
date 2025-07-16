<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Categoria;
use App\Models\Avaliacao;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServicoApiController extends Controller
{
    // GET /api/v1/servicos
    public function index(Request $request)
    {
        $pesquisa = $request->input('search');
        $id_categoria = $request->input('categoria_id');

        $query = Servico::with('categoriaR', 'prestador');

        if ($pesquisa) {
            $query->where('nome_servico', 'like', "%{$pesquisa}%");
        }

        if ($id_categoria) {
            $query->where('categoria', $id_categoria);
        }

        $servicos = $query->get()->map(function ($servico) {
            $servico->url_foto = $servico->caminho_foto
                ? Storage::disk('miniobusca')->temporaryUrl($servico->caminho_foto, now()->addMinutes(5))
                : "https://static.wixstatic.com/media/1233ff_ca96ec225309492dbd2cef0b7ca9938f~mv2.jpg";
            return $servico;
        });

        return response()->json([
            'servicos' => $servicos,
            'categorias' => Categoria::all()
        ]);
    }

    // POST /api/v1/servicos
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'nome' => 'required|string|min:20|max:40',
    //         'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'categoria' => 'required|exists:Categoria,id',
    //         'descricao' => 'required|string|max:750',
    //     ]);

    //     $path = $request->file('imagem')->store('imagens/servicos', 'minio');

    //     $servico = Servico::create([
    //         'nome_servico' => $validated['nome'],
    //         'categoria' => $validated['categoria'],
    //         'desc_servico' => $validated['descricao'],
    //         'caminho_foto' => $path,
    //         'usuario_id' => Auth::id(),
    //     ]);

    //     return response()->json([
    //         'message' => 'Serviço criado com sucesso!',
    //         'servico' => $servico,
    //     ], 201);
    // }

    // GET /api/v1/servicos/{id}
    public function show($id)
    {
        $servico = Servico::with('prestador')->findOrFail($id);
        $servico->url_foto = $servico->caminho_foto
            ? Storage::disk('miniobusca')->temporaryUrl($servico->caminho_foto, now()->addMinutes(5))
            : null;

        $servico->prestador->url_foto = $servico->prestador->caminho_img
            ? Storage::disk('miniobusca')->temporaryUrl($servico->prestador->caminho_img, now()->addMinutes(5))
            : asset('images/user-icon.png');

        $avaliacoes = Avaliacao::where('id_servico', $id)
            ->with('cliente')
            ->get()
            ->map(function ($avaliacao) {
                $avaliacao->cliente->url_foto = $avaliacao->cliente->caminho_img
                    ? Storage::disk('miniobusca')->temporaryUrl($avaliacao->cliente->caminho_img, now()->addMinutes(5))
                    : asset('images/user-icon.png');
                return $avaliacao;
            });

        return response()->json([
            'servico' => $servico,
            'avaliacoes' => $avaliacoes,
        ]);
    }

    // GET /api/v1/prestador/{id}
    public function showPrestador($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->url_foto = $usuario->caminho_img
            ? Storage::disk('miniobusca')->temporaryUrl($usuario->caminho_img, now()->addMinutes(5))
            : asset('images/user-icon.png');

        return response()->json([
            'prestador' => $usuario,
        ]);
    }
}
