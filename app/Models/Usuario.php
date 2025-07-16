<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'Usuario';

    /**
     * Os atributos que podem ser preenchidos em massa.
     * Atualizado para corresponder à sua migration 'create_users_table'.
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'email',
        'senha',
        'is_admin',
        'cpf_cnpj',
        'data_nascimento',
        'telefone',
        'area_atuacao',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'descricao',
        'caminho_img',
        'rede_social1',
        'rede_social2',
        'rede_social3',
        'rede_social4',
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

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function formacao()
    {
        // O segundo argumento 'area_atuacao' pode precisar ser alterado para 'formacao_id'
        return $this->belongsTo(Formacao::class, 'area_atuacao');
    }

    public function servicos()
    {
        return $this->hasMany(Servico::class, 'usuario_id');
    }
}
