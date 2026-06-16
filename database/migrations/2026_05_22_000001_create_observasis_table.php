<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservasisTable extends Migration
{
    public function up()
    {
        Schema::create('observasis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_register_id');
            $table->json('aktivitas')->nullable();
            $table->text('catatan')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('data_register_id')
                ->references('id')
                ->on('data_registers')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('observasis');
    }
}
