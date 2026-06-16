<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnikomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unikoms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_unikom');
            $table->integer('skema_id')->index('unikoms_skema_id_foreign');
            $table->string('unikom');
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
        Schema::dropIfExists('unikoms');
    }
}
