<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPagamento extends Model
{
    protected $table = 'Status_Pagamento';

    protected $fillable = [
        'status',
    ];
}
