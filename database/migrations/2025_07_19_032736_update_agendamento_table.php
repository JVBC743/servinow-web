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
        Schema::table('Agendamento', function (Blueprint $table) {
            $table->dropForeign(['id_cliente']);
            $table->foreign('id_cliente')
                ->references('id')
                ->on('Usuario')
                ->onDelete('cascade');

            $table->dropForeign(['id_prestador']);
            $table->foreign('id_prestador')
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
            $table->dropForeign(['id_cliente']);
            $table->dropForeign(['id_prestador']);
        });

    }
};