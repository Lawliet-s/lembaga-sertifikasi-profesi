<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataRegistersBackupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_registers_backup', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('skema_name')->nullable();
            $table->string('skema_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('status')->nullable();
            $table->string('surel')->nullable();
            $table->string('tmpt_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('sex_id')->nullable();
            $table->string('negara')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kode_post', 50)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('image')->nullable();
            $table->integer('jurusan_id')->nullable();
            $table->integer('semester_id')->nullable();
            $table->string('nim', 200)->nullable();
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->integer('asesor_id')->nullable();
            $table->bigInteger('tuk_id')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('kode')->nullable();
            $table->string('id_skema')->nullable();
            $table->string('kode_skema')->nullable();
            $table->string('jenis', 20)->nullable();
            $table->string('koreksi')->nullable();
            $table->string('rmh', 50)->nullable();
            $table->string('tmt', 50)->nullable();
            $table->string('ktr', 50)->nullable();
            $table->string('institusi', 50)->nullable();
            $table->string('alamat_kantor', 50)->nullable();
            $table->string('email3', 50)->nullable();
            $table->string('jabatan', 50)->nullable();
            $table->string('telp', 50)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('postal', 50)->nullable();
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
        Schema::dropIfExists('data_registers_backup');
    }
}
