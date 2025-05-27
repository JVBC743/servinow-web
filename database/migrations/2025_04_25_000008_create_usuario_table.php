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
        if(!Schema::hasTable('Usuario')){
            Schema::create('Usuario', function (Blueprint $table) {
                $table->id();
                $table->string('nome', length: 50);
                $table->string('senha', length: 60);
                $table->text('descricao');
                $table->string('telefone', length: 15);
                $table->string('email', length: 80);
                $table->string('cpf_cnpj', length: 14);
                $table->unsignedBigInteger('area_atuacao');
                $table->timestamps();
                $table->foreign('area_atuacao')->references('id')->on('Formacao');

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Usuario');
    }
};
