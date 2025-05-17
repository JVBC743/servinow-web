<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "Usuario";

    protected $fillable = [
        'nome',
        'senha',
        'telefone',
        'email',
        'cpf_cnpj',
        'area_atuacao',
    ];

    protected $hidden = [
        'senha',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'senha' => 'hashed',
        ];
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function formacao()
    {
        return $this->belongsTo(Formacao::class, 'area_atuacao');
    }
}
