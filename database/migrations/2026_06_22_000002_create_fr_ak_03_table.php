<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fr_ak_03', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_register_id');
            $table->unsignedInteger('user_id');
            $table->integer('rating')->default(5);
            $table->text('feedback')->nullable();
            $table->text('catatan')->nullable();
            $table->text('saran')->nullable();
            $table->timestamps();

            $table->unique('data_register_id');
            $table->foreign('data_register_id')->references('id')->on('data_registers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fr_ak_03');
    }
};
