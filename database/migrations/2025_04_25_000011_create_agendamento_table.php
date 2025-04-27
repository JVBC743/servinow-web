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
        if(!Schema::hasTable('Agendamento')){
            Schema::create('Agendamento', function (Blueprint $table) {

                $table->id();
                $table->unsignedBigInteger('id_cliente');
                $table->unsignedBigInteger('id_servico');
                $table->unsignedBigInteger('id_prestador');
                $table->dateTime('data_agendamento', precision: 0);
                $table->unsignedBigInteger('status');
                $table->text('notificacao');
                $table->timestamps();

                $table->foreign('id_cliente')->references('id')->on('Usuario');
                $table->foreign('id_servico')->references('id')->on('Servico');
                $table->foreign('id_prestador')->references('id')->on('Usuario');
                $table->foreign('status')->references('id')->on('Status_Agendamento');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Agendamento');
    }
};
