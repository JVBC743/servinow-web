<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('Pagamento', function (Blueprint $table) {
            $table->uuid('codigo')->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::table('Pagamento', function (Blueprint $table) {
            $table->dropColumn('codigo');
        });
    }
};
