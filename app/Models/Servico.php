<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servico extends Model
{
    use HasFactory;

    protected $table = 'Servico';

    protected $fillable = [
        'nome_servico',
        'categoria',
        'desc_servico',
        'caminho_foto',
        'usuario_id',
    ];

    public function categoriaR()
    {
        return $this->belongsTo(Categoria::class, 'categoria');
    }

    public function prestador(){
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function avaliacoes(){
        return $this->hasMany(Avaliacao::class, 'id_servico');
    }

    
}
