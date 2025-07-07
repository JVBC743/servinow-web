<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Servico;
use App\Models\StatusAgendamento;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agendamento extends Model
{

    use HasFactory;


    protected $table = 'Agendamento';

    protected $fillable = [
        'id_cliente',
        'id_servico',
        'id_prestador',
        'data_agendamento',
        'status',
        'notificacao',
    ];

    protected $casts = [
        'data_agendamento' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'id_cliente');
    }

    public function prestador()
    {
        return $this->belongsTo(Usuario::class, 'id_prestador');
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'id_servico');
    }

    public function status()
    {
        return $this->belongsTo(StatusAgendamento::class, 'status');
    }
}
