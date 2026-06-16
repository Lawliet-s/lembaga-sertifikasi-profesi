<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsesorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesor', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nik', 50)->nullable()->unique('nik');
            $table->string('nama', 75)->nullable();
            $table->string('image')->nullable();
            $table->string('alamat', 50)->nullable();
            $table->string('sex', 50)->nullable();
            $table->string('email', 50)->nullable()->unique('email');
            $table->string('status', 50)->nullable();
            $table->timestamp('updated_at', 6)->useCurrent();
            $table->timestamp('created_at', 6)->useCurrent();
            $table->string('no_hp', 20)->nullable();
            $table->string('skema', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asesor');
    }
}
