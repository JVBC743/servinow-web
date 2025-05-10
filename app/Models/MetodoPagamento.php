<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPagamento extends Model
{
    protected $table = 'metodos_pagamento';

    protected $fillable = [
        'metodo',
    ];
}
