<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Servico extends Model
{
    protected $table = 'Servico';

    protected $fillable = [
        'nome_servico',
        'categoria',
        'desc_servico',
        'caminho_img',
        'usuario_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria');
    }

    public function user(){
        return $this->hasOne(Usuario::class, 'usuario_id');
    }
}
