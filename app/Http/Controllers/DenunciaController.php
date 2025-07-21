<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use Illuminate\Http\Request;
use App\Http\Requests\CreateDenunciaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Container\Attributes\Storage;
use App\Models\Usuario;

class DenunciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function indexMotivos()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateDenunciaRequest $request, $id)
    {   
        $denunciado = $request->input('id_prestador');

        $prestador = Usuario::find($denunciado);

        if(!$prestador){
            return redirect()->back()->with('error', 'O prestador não foi encontrado no banco.');
        }

        $data = $request->validated();

        if ($request->hasFile('anexo')) {
            $path = $request->file('anexo')->store('denuncia/anexos', 'minio');
            $data['caminho_arquivo'] = $path;
        }
        
        Denuncia::create([

            'id_denunciante' => Auth::id(),
            'id_denunciado' => $denunciado,
            'titulo' => $data['titulo'],
            'id_motivo' => $data['motivo'],
            'descricao' => $data['descricao'],
            'caminho_arquivo' => $data['caminho_arquivo'] ?? null,

        ]);

        return redirect()->back()->with('success', 'A denuncia foi realizada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Denuncia $denuncia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Denuncia $denuncia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Denuncia $denuncia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Denuncia $denuncia)
    {
        //
    }
}
