<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Servico;
use Illuminate\Http\Request;
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
        // Validação
        $request->validate([
            'nome' => 'required|string|max:40|min:3',
            'descricao' => 'required|string|max:750',
            'categoria' => 'required|integer|exists:Categoria,id',
            'imagem' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $path = $request->file('imagem')->store('servicos', 'minio');
        } else {
            return back()->withErrors(['imagem' => 'Imagem inválida'])->withInput();
        }

        // Criação do serviço
        Servico::create([
            'nome_servico' => $request->nome,
            'desc_servico' => $request->descricao,
            'categoria' => $request->categoria,
            'caminho_foto' => $path,
            // 'usuario_id' => auth()->id() ?? 1, // opcional: se tiver autenticação
        ]);

        return redirect()->route('servico.index')->with('success', 'Serviço cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $servico = Servico::findOrFail($id);
        return view('pages.detalhe-servico', compact('servico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $servico = Servico::findOrFail($id);
        return view('pages.edicao-servico', compact('servico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $servico = Servico::findOrFail($id);

        // Validação
        $request->validate([
            'nome' => 'required|string|max:40|min:3',
            'descricao' => 'required|string|max:750',
            'categoria' => 'required|string|max:50',
            'imagem' => 'nullable|image|max:2048', // imagem é opcional na edição
        ]);

        // Se tiver imagem nova, faz upload e apaga a antiga
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            // Deleta imagem antiga
            if ($servico->imagem && Storage::disk('minio')->exists($servico->imagem)) {
                Storage::disk('minio')->delete($servico->imagem);
            }
            // Upload nova imagem
            $path = $request->file('imagem')->store('servicos', 'minio');
            $servico->imagem = $path;
        }

        // Atualiza dados
        $servico->nome = $request->nome;
        $servico->descricao = $request->descricao;
        $servico->categoria = $request->categoria;

        $servico->save();

        return redirect()->route('servico.index')->with('success', 'Serviço atualizado com sucesso!');
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
