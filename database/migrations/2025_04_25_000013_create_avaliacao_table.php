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

        if(!Schema::hasTable('Avaliacao')){
            Schema::create('Avaliacao', function (Blueprint $table) {
                $table->id();
                
                $table->unsignedBigInteger('id_cliente');
                $table->unsignedBigInteger('id_servico');
                $table->dateTime('data_avaliacao', precision: 0);
                $table->enum('nota', [1, 2, 3, 4 ,5]);
                $table->text('comentario');
                $table->timestamps();

                $table->foreign('id_cliente')->references('id')->on('Usuario');
                $table->foreign('id_servico')->references('id')->on('Servico');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Avaliacao');
    }
};
