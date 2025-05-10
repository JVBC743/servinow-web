<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Agendamento;
use App\Models\StatusPagamento;
use App\Models\MetodoPagamento;

class Pagamento extends Model
{
    protected $table = 'pagamentos';

    protected $fillable = [
        'id_agendamento',
        'status',
        'data_pagamento',
        'metodo',
    ];

    protected $casts = [
        'data_pagamento' => 'datetime',
    ];

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class, 'id_agendamento');
    }

    public function status()
    {
        return $this->belongsTo(StatusPagamento::class, 'status');
    }

    public function metodo()
    {
        return $this->belongsTo(MetodoPagamento::class, 'metodo');
    }
}
