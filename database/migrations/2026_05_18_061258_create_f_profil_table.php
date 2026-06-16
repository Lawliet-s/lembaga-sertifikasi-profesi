<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFProfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_profil', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('profil')->nullable();
            $table->text('isi')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('motto')->nullable();
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
        Schema::dropIfExists('f_profil');
    }
}
