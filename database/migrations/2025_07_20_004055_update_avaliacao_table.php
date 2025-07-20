<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('Avaliacao', function (Blueprint $table) {
            $table->dropForeign(['id_cliente']);
            $table->foreign('id_cliente')->references('id')->on('Usuario')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('Avaliacao', function (Blueprint $table) {
            $table->dropForeign(['id_cliente']);
            $table->foreign('id_cliente')->references('id')->on('Usuario');
        });
    }
};