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
         Schema::table('Avaliacao', function (Blueprint $table) {
            $table->dropForeign(['id_servico']);
            $table->foreign('id_servico')
                ->references('id')
                ->on('Usuario')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Agendamento', function (Blueprint $table) {
            $table->dropForeign(['id_servico']);
        });
    }
};
