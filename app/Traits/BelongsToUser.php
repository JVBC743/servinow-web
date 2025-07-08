<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait BelongsToUser
{
    /**
     * Aplica um scope para restringir a consulta aos dados do usuário autenticado.
     */
    public static function bootBelongsToUser()
    {
        static::addGlobalScope('usuario', function (Builder $builder) {
            if (Auth::check()) {
                $builder->where('usuario_id', Auth::id());
            }
        });
    }

    /**
     * Define o relacionamento com o usuário (opcional).
     */
    public function usuario()
    {
        return $this->belongsTo(\App\Models\Usuario::class, 'usuario_id');
    }
}
