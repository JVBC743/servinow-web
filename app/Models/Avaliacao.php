<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Servico;

class Avaliacao extends Model
{
    protected $table = 'Avaliacao';

    protected $fillable = [
        'id_cliente',
        'id_servico',
        'data_avaliacao',
        'nota',
        'comentario',
    ];

    protected $casts = [
        'data_avaliacao' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'id_cliente');
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'id_servico');
    }
}
