<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cartoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('Usuario')->onDelete('cascade');
            $table->string('holder');
            $table->string('number_encrypted');
            $table->string('expiry_encrypted');
            $table->string('cvv_encrypted');
            $table->string('bandeira')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cartoes');
    }
};
