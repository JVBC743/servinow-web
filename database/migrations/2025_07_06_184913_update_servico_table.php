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
        Schema::table('Servico', function (Blueprint $table) {
            $table->string('nome_servico', 225)->change();
            $table->string('caminho_foto', 225)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Servico', function (Blueprint $table) {
            $table->string('nome_servico', 40)->change();
            $table->string('caminho_foto', 40)->change();
        });
    }
};
