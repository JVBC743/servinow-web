<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServicoRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Servico;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showCadastro(){

        $listaCategorias = Categoria::all();
        
        return view ('pages.cadastro-servico', compact('listaCategorias'));

    }
    public function create(CreateServicoRequest $request)
    {   
        $data = $request->validated();
        // dd($data);

        $servico = Servico::create($data);

        return redirect()->back()->with('success', 'Serviço cadastrado com sucesso.');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
