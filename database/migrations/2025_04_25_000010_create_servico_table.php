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
        if(!Schema::hasTable('Servico')){
            Schema::create('Servico', function (Blueprint $table) {
                $table->id();
                $table->string('nome_servico', length: 40);
                $table->text('desc_servico');
                $table->string('caminho_foto', 40);
                $table->unsignedBigInteger('categoria');
                $table->timestamps();

                $table->foreign('categoria')->references('id')->on('Categoria');

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Servico');
    }
};
