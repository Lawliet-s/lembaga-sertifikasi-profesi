<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('data_pribadis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_id')->constrained('permohonan_sertifikasis')->onDelete('cascade')->unique();
            $table->string('nama_lengkap');
            $table->string('nik', 20);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('kebangsaan')->default('Indonesia');
            $table->text('alamat');
            $table->string('kode_pos', 10);
            $table->string('no_hp', 20);
            $table->string('email');
            $table->string('pendidikan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_pribadis');
    }
};
