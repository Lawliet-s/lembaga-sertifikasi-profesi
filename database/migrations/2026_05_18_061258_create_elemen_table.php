<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElemenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elemen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('unikom_id')->index('asesmens_unikom_id_foreign');
            $table->string('asesmen');
            $table->text('kriteria')->nullable();
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
        Schema::dropIfExists('elemen');
    }
}
