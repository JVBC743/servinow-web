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
        Schema::create('Servico', function (Blueprint $table) {
            $table->id();
            $table->string('nome_servico', length: 40);
            $table->foreign('categoria')->references('id')->on('Categoria');
            $table->text('desc_servico');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Servico');
    }
};
