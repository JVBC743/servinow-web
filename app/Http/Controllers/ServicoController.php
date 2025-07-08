<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicos = Servico::paginate(10); // paginação de 10 por página
        return view('pages.lista-servicos', compact('servicos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all(); // pega todas as categorias
        return view('pages.cadastro-servico', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|min:20|max:40',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria' => 'required|exists:Categoria,id',
            'descricao' => 'required|string|max:750',
        ]);

        // Upload da imagem para MinIO (supondo disco minio configurado)
        $path = $request->file('imagem')->store('imagens/servicos', 'minio');

        // Criar serviço com usuário logado
        Servico::create([
            'nome_servico' => $validatedData['nome'],
            'categoria' => $validatedData['categoria'],
            'desc_servico' => $validatedData['descricao'],
            'caminho_foto' => $path,
            'usuario_id' => Auth::id(),
        ]);

        return redirect()->route('servico.index')->with('success', 'Serviço criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        // $usr = Usuario::find($id);

        $servico = Servico::findOrFail($id);
        return view('pages.servico', compact('servico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $servico = Servico::findOrFail($id);
        $categorias = Categoria::all();

        // Gera a URL da imagem (caso exista)
        $imagemUrl = $servico->caminho_foto
            ? Storage::disk('miniobusca')->temporaryUrl($servico->caminho_foto, now()->addMinutes(5))
            : null;

        return view('pages.edicao-servico', compact('servico', 'categorias', 'imagemUrl'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $servico = Servico::findOrFail($id);

        $validatedData = $request->validate([
            'nome' => 'required|string|min:20|max:40',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria' => 'required|exists:Categoria,id',
            'descricao' => 'required|string|max:750',
        ]);

        $servico->nome_servico = $validatedData['nome'];
        $servico->categoria = $validatedData['categoria'];
        $servico->desc_servico = $validatedData['descricao'];

        if ($request->hasFile('imagem')) {
            if ($servico->caminho_img) {
                // Apaga imagem antiga
                Storage::disk('minio')->delete($servico->caminho_foto);
            }

            $path = $request->file('imagem')->store('imagens/servicos', 'minio');
            $servico->caminho_foto = $path;
        }

        $servico->save();

        return redirect()->route('servico.index')->with('success', 'Serviço atualizado com sucesso.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $servico = Servico::findOrFail($id);

        // Deleta imagem do MinIO
        if ($servico->imagem && Storage::disk('minio')->exists($servico->imagem)) {
            Storage::disk('minio')->delete($servico->imagem);
        }

        $servico->delete();

        return redirect()->route('servico.index')->with('success', 'Serviço excluído com sucesso!');
    }
}
