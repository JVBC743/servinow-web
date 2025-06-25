<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Corresponde ao campo "Nome*"
            $table->string('email')->unique(); // Corresponde ao campo "E-mail*"
            $table->string('cpf')->unique(); // Corresponde ao campo "CPF*"
            $table->date('data_nascimento'); // Corresponde ao campo "Data de Nascimento*"
            $table->string('celular'); // Corresponde ao campo "Número de celular*"
            $table->string('cep'); // Corresponde ao campo "CEP*"
            $table->string('logradouro'); // Corresponde ao campo "logradouro*"
            $table->string('numero'); // Corresponde ao campo "número*"
            $table->string('complemento')->nullable(); // Corresponde ao campo "complemento" (não é obrigatório)
            $table->string('bairro'); // Corresponde ao campo "Bairro*"
            $table->string('cidade'); // Corresponde ao campo "Cidade*"
            $table->string('uf', 2); // Corresponde ao campo "UF*"
            $table->string('senha'); // Corresponde ao campo "Senha*"
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps(); // Cria as colunas created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
