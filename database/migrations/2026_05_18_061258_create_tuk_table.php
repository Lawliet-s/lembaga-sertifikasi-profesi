<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuk', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('kode', 50)->nullable();
            $table->string('pengelola', 50)->nullable();
            $table->string('tuk', 50)->nullable();
            $table->string('alamat', 50)->nullable();
            $table->string('image')->nullable();
            $table->timestamp('updated_at', 6)->useCurrent();
            $table->timestamp('created_at', 6)->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tuk');
    }
}
