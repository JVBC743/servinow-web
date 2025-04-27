<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formacao extends Model
{
    protected $table = 'formacoes';

    protected $fillable = [
        'formacao',
    ];
}
