<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fr_ak_01', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_register_id');
            $table->unsignedInteger('user_id');
            $table->text('ttd')->nullable();
            $table->string('ttd_path')->nullable();
            $table->timestamp('agreed_at')->nullable();
            $table->enum('status', ['draft', 'signed'])->default('draft');
            $table->timestamps();

            $table->unique('data_register_id');
            $table->foreign('data_register_id')->references('id')->on('data_registers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fr_ak_01');
    }
};
