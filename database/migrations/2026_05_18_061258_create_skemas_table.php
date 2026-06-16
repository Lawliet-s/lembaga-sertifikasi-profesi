<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skemas', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('kode_skema');
            $table->string('skema');
            $table->unsignedInteger('prodi_id');
            $table->string('status_id', 20);
            $table->unsignedInteger('tuk_id');
            $table->unsignedInteger('asesor_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skemas');
    }
}
