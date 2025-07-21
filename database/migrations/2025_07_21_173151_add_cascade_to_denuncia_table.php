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
        Schema::table('Denuncia', function (Blueprint $table) {

            $table->dropForeign(['id_denunciante']);
            $table->foreign('id_denunciante')->references('id')->on('Usuario')->onDelete('cascade');

            $table->dropForeign(['id_denunciado']);
            $table->foreign('id_denunciado')->references('id')->on('Usuario')->onDelete('cascade');

            $table->foreign('id_servico')->references('id')->on('Servico')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Denuncia', function (Blueprint $table) {
            $table->dropForeign(['id_denunciante']);
            $table->foreign('id_denunciante')->references('id')->on('Usuario');

            $table->dropForeign(['id_denunciado']);
            $table->foreign('id_denunciado')->references('id')->on('Usuario');

            $table->foreign('id_servico')->references('id')->on('Servico');
        });
    }
};
