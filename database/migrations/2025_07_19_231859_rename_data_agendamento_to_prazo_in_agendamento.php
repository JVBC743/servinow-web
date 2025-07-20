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
        Schema::table('Agendamento', function (Blueprint $table) {
            $table->renameColumn('data_agendamento', 'prazo');
        });
    }

    public function down()
    {
        Schema::table('nome_da_tabela', function (Blueprint $table) {
            $table->renameColumn('data_agendamento', 'prazo');
        });
    }
};
