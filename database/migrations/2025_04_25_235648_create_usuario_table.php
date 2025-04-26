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
        Schema::create('Usuario', function (Blueprint $table) {
            $table->id();
            $table->string('nome', length: 50);
            $table->string('senha', length: 60);
            $table->string('telefone', length: 15);
            $table->string('email', length: 80);
            $table->string('cpf_cnpj', length: 14);
            $table->foreign('area_atuacao')->references('id')->on('Formacao');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Usuario');
    }
};
