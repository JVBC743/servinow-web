<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Servico;
use App\Models\StatusAgendamento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Agendamento extends Model
{

    use HasFactory;


    protected $table = 'Agendamento';

    protected $fillable = [
        'id_cliente',
        'id_servico',
        'id_prestador',
        'prazo',
        'status',
        'notificacao',
        'descricao',
    ];

    // protected $casts = [
    //     'prazo' => 'datetime',
    // ];

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

    public function statusAgendamento()
    {
        return $this->belongsTo(StatusAgendamento::class, 'status', 'id');
    }
    public function getPrazoFormatadoAttribute()
    {
        return Carbon::parse($this->prazo)->format('d/m/Y');
    }
}
