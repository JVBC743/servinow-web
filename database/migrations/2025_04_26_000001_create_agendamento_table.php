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
        Schema::create('Agendamento', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_cliente')->references('id')->on('Usuario');
            $table->foreign('id_servico')->references('id')->on('Servico');
            $table->foreign('id_prestador')->references('id')->on('Usuario');
            $table->dateTime('data_agendamento', precision: 0);
            $table->foreign('status')->references('id')->on('Status_Agendamento');
            $table->text('notificacao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Agendamento');
    }
};
