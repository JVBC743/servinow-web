<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPagamento extends Model
{
    protected $table = 'Metodo_Pagamento';

    protected $fillable = [
        'metodo',
    ];
}
