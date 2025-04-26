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
        Schema::create('Pagamento', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_pagamento')->references('id')->on('Agendamento');
            $table->foreign('status')->references('id')->on('Status_Pagamento');
            $table->dataTime('data_pagamento', precision: 0);
            $table->foreign('metodo')->references('id')->on('Metodo_Pagamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Pagamento');
    }
};
