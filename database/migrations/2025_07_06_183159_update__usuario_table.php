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
            $table->string('rede_social1', 255)->nullable()->change();
            $table->string('rede_social2', 255)->nullable()->change();
            $table->string('rede_social3', 255)->nullable()->change();
            $table->string('rede_social4', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Usuario', function (Blueprint $table) {
            $table->string('rede_social1', 40)->nullable()->change();
            $table->string('rede_social2', 40)->nullable()->change();
            $table->string('rede_social3', 40)->nullable()->change();
            $table->string('rede_social4', 40)->nullable()->change();
        });
    }
};
