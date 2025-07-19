<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{
    protected $table = 'cartoes';

    protected $fillable = [
        'user_id',
        'holder',
        'number_encrypted',
        'expiry_encrypted',
        'cvv_encrypted',
        'bandeira',
    ];

    // Relacionamento com usuário
    public function user()
    {
        return $this->belongsTo(Usuario::class);
    }

    // Retorna os dados do cartão descriptografados em array
    public function getDecryptedData()
    {
        return [
            'number' => decrypt($this->number_encrypted),
            'expiry' => decrypt($this->expiry_encrypted),
            'cvv'    => decrypt($this->cvv_encrypted),
            'holder' => $this->holder,
            'bandeira' => $this->bandeira,
        ];
    }

    // Define e criptografa os dados do cartão
    public function setEncryptedData($number, $expiry, $cvv)
    {
        $this->number_encrypted = encrypt($number);
        $this->expiry_encrypted = encrypt($expiry);
        $this->cvv_encrypted = encrypt($cvv);
    }
}
// Note: Ensure to implement proper encryption/decryption methods for sensitive data.
