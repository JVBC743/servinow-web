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
            $table->dropForeign(['usuario_id']);
            $table->foreign('usuario_id')
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
        Schema::table('Servico', function (Blueprint $table) {
            $table->dropForeign(['usuario_id']);
        });
    }
};
