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
        Schema::table('Usuario', function (Blueprint $table) {
            $table->string('caminho_img', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Usuario', function (Blueprint $table) {
            $table->string('caminho_img', 60)->nullable()->change(); // volta para o original
        });
    }
};
