<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Servico;
use App\Models\Agendamento;
use App\Models\Usuario;
use App\Models\Avaliacao;

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
        $servicos = Servico::paginate(10);
        $categorias = Categoria::all();
        return view('pages.servicos-cadastrados', compact('servicos', 'categorias'));
    }

    public function indexPrestador()
    {
        $id = Auth::id();

        $servicos = Servico::where('usuario_id', $id)->get();

        return view('pages.servicos-cadastrados', compact('servicos'));
    }

    public function dashboard(Request $request)
    {
        $pesquisa = $request->input('search');
        $id_categoria = $request->input('categoria_id');

        $query = Servico::query();

        if($pesquisa){
            $query->where('nome_servico', 'like', "%{$pesquisa}%");
        }

        if($id_categoria){
            $query->where('categoria', $id_categoria);
        }

        $servicos = $query->get();
        $servicos = $servicos->map(function ($servico) {
            if($servico->caminho_foto)
                $servico->url_foto = Storage::disk('miniobusca')->temporaryUrl($servico->caminho_foto, now()->addMinutes(5));
            else
                $servico->url_foto = "https://static.wixstatic.com/media/1233ff_ca96ec225309492dbd2cef0b7ca9938f~mv2.jpg/v1/fill/w_740,h_493,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/1233ff_ca96ec225309492dbd2cef0b7ca9938f~mv2.jpg";
            return $servico;
        });
        $categorias = Categoria::all();

        return view('pages.dashboard', compact('servicos', 'pesquisa', 'categorias'));
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

        return redirect()->route('servicos.cadastrados')->with('success', 'Serviço criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $servico = Servico::with('prestador')->findOrFail($id);
        if($servico->caminho_foto)
            $servico->url_foto = Storage::disk('miniobusca')->temporaryUrl($servico->caminho_foto, now()->addMinutes(5));
        if($servico->prestador->caminho_img)
            $servico->prestador->url_foto = Storage::disk('miniobusca')->temporaryUrl($servico->prestador->caminho_img, now()->addMinutes(5));
        $avaliacoes = Avaliacao::where('id_servico', $id)->with('cliente')->get();
        $avaliacoes = $avaliacoes->map(function ($avaliacao) {
            if($avaliacao->cliente->caminho_img){
                $avaliacao->cliente->url_foto = Storage::disk('miniobusca')->temporaryUrl($avaliacao->cliente->caminho_img, now()->addMinutes(5));
            } else {
                $avaliacao->cliente->url_foto = asset('images/user-icon.png');
            }
            return $avaliacao;
        });
        return view('pages.servico', compact('servico','avaliacoes'));
    }

    public function showPrestador($id)
    {

        $usr = Usuario::findOrFail($id);
        if($usr->caminho_img)
            $usr->url_foto = Storage::disk('miniobusca')->temporaryUrl($usr->caminho_img, now()->addMinutes(5));
        return view('pages.visualizacao-perfil-prestador', compact('usr'));
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

        return redirect()->route('servicos.cadastrados')->with('success', 'Serviço atualizado com sucesso.');
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

        Agendamento::where('id_servico', $servico->id)->delete();

        $servico->delete();

        return redirect()->route('servicos.cadastrados')->with('success', 'Serviço excluído com sucesso!');
    }
}