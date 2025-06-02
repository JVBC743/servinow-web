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
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria');
    }
}
