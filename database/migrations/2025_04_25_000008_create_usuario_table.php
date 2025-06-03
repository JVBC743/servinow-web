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
                $table->text('descricao')->nullable();
                $table->string('telefone', length: 50);
                $table->string('email', length: 80);
                $table->string('cpf_cnpj', length: 14);
                $table->unsignedBigInteger('area_atuacao');
                $table->string('caminho_img', length: 60);
                $table->string('rede_social1', length: 40);
                $table->string('rede_social2', length: 40);
                $table->string('rede_social3', length: 40);
                $table->string('rede_social4', length: 40);

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
