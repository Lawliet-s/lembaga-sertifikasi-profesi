<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permohonan_sertifikasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('skema_id')->nullable();
            $table->enum('tujuan_asesmen', ['sertifikasi', 'pkt', 'rpl', 'lainnya'])->default('sertifikasi');
            $table->enum('status', ['pending', 'diverifikasi', 'revisi', 'ditolak', 'selesai'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('permohonan_sertifikasis');
    }
};
