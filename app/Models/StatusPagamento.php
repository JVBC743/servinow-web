<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPagamento extends Model
{
    protected $table = 'status_pagamentos';

    protected $fillable = [
        'status',
    ];
}
