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
            $table->string("caminho_img")->after("desc_servico");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Servico', function (Blueprint $table) {
            $table->dropColumn("caminho_img");
        });
    }
};
