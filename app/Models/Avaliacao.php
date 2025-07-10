<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Servico;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Avaliacao extends Model
{

    use HasFactory;
    
    protected $table = 'Avaliacao';

    protected $fillable = [
        'id_cliente',
        'id_servico',
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
