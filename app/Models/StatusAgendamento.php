<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusAgendamento extends Model
{
    protected $table = 'status_agendamentos';

    protected $fillable = [
        'status',
    ];
}
