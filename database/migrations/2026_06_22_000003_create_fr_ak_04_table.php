<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fr_ak_04', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_register_id');
            $table->unsignedInteger('user_id');
            $table->text('alasan');
            $table->string('file_path')->nullable();
            $table->enum('status', ['diajukan', 'ditinjau', 'diterima', 'ditolak'])->default('diajukan');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('diajukan_at')->nullable();
            $table->timestamp('ditinjau_at')->nullable();
            $table->timestamp('diputus_at')->nullable();
            $table->timestamps();

            $table->unique('data_register_id');
            $table->foreign('data_register_id')->references('id')->on('data_registers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fr_ak_04');
    }
};
