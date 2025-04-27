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

        if(!Schema::hasTable('Pagamento')){
            Schema::create('Pagamento', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('status');
                $table->unsignedBigInteger('metodo');
                $table->unsignedBigInteger('id_agendamento');
                $table->dateTime('data_pagamento', precision: 0);
                $table->timestamps();

                $table->foreign('status')->references('id')->on('Status_Pagamento');
                $table->foreign('metodo')->references('id')->on('Metodo_Pagamento');
                $table->foreign('id_agendamento')->references('id')->on('Agendamento');

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Pagamento');
    }
};
