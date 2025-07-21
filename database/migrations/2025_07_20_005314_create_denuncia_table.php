<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('Denuncia', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_denunciante');
            $table->unsignedBigInteger('id_denunciado');
            $table->unsignedBigInteger('id_motivo');
            
            $table->string('titulo');
            $table->text('descricao')->nullable();

            $table->foreign('id_motivo')->references('id')->on('Motivo');
            $table->foreign('id_denunciante')->references('id')->on('Usuario');
            $table->foreign('id_denunciado')->references('id')->on('Usuario');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('denuncia');
    }
};