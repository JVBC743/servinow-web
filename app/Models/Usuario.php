<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * A tabela associada a este model.
     * Precisamos definir isso porque o nome da classe 'Usuario' não corresponde à tabela 'users'.
     * @var string
     */
    protected $table = 'users';

    /**
     * Os atributos que podem ser preenchidos em massa.
     * Atualizado para corresponder à sua migration 'create_users_table'.
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'senha',
        'cpf',
        'data_nascimento',
        'celular',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
    ];

    /**
     * Os atributos que devem ser ocultados na serialização (ex: ao retornar como JSON).
     * @var array<int, string>
     */
    protected $hidden = [
        'senha', // alterado de 'senha' para 'password'
        'remember_token',
    ];

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'senha' => 'hashed', // alterado de 'senha' para 'password'
        ];
    }

    /**
      * ATENÇÃO: Verifique se esta relação ainda é necessária.
      * Se for, você precisará adicionar a coluna 'formacao_id' (ou similar)
      * à sua migration 'create_users_table'.
      */
    public function formacao()
    {
        // O segundo argumento 'area_atuacao' pode precisar ser alterado para 'formacao_id'
        return $this->belongsTo(Formacao::class, 'area_atuacao');
    }
}
