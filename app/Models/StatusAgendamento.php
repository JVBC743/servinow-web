<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusAgendamento extends Model
{
    protected $table = 'Status_Agendamento';

    protected $fillable = [
        'status',
    ];
}
