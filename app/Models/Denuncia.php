<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    protected $table = 'Denuncia';

    protected $fillable = [
        'id_denunciante',
        'id_denunciado',
        'id_motivo',
        'titulo',
        'descricao',
        'caminho_arquivo'
    ];
    
    public function denunciante()
    {
        return $this->belongsTo(Motivo::class, 'categoria');
    }

    public function denunciado()
    {
        return $this->belongsTo(Motivo::class, 'categoria');
    }

    public function motivo()
    {
        return $this->belongsTo(Motivo::class, 'categoria');
    }

}
