<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('Denuncia', function (Blueprint $table) {
            $table->string('caminho_arquivo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('caminho_arquivo');
    }
};