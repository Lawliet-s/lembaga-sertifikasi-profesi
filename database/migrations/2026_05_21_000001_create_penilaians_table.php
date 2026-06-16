<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiansTable extends Migration
{
    public function up()
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_register_id');
            $table->unsignedBigInteger('unikom_id');
            $table->enum('nilai', ['kompeten', 'belum'])->nullable();
            $table->timestamps();

            $table->foreign('data_register_id')
                ->references('id')
                ->on('data_registers')
                ->onDelete('cascade');

            $table->foreign('unikom_id')
                ->references('id')
                ->on('unikoms')
                ->onDelete('cascade');

            $table->unique(['data_register_id', 'unikom_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaians');
    }
}
