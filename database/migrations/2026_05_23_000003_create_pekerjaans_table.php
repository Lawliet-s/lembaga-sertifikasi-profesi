<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_id')->constrained('permohonan_sertifikasis')->onDelete('cascade')->unique();
            $table->string('nama_perusahaan');
            $table->string('jabatan');
            $table->text('alamat_kantor');
            $table->string('kode_pos_kantor', 10);
            $table->string('telepon_kantor', 20);
            $table->string('email_kantor');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pekerjaans');
    }
};
