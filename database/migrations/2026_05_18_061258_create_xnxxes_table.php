<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXnxxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xnxxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('kode_elemen');
            $table->text('kriteria')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('unikom_id')->nullable();
            $table->string('unikom_name')->nullable();
            $table->string('asesmen_name')->nullable();
            $table->string('skema_name')->nullable();
            $table->bigInteger('skema_id')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->bigInteger('data_register_id')->nullable()->index('xnxxes_data_register_id_foreign');
            $table->bigInteger('kode')->nullable();
            $table->string('koreksi')->nullable();
            $table->string('unikom_kode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xnxxes');
    }
}
