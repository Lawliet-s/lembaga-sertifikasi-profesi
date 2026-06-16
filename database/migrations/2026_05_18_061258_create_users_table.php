<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role', 111)->nullable();
            $table->string('name');
            $table->string('email', 20)->unique();
            $table->integer('kode')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('negara')->nullable();
            $table->string('sex_id')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('institusi', 50)->nullable();
            $table->integer('tamatan_id')->nullable();
            $table->string('jabatan')->nullable();
            $table->integer('jurusan_id')->nullable();
            $table->integer('semester_id')->nullable();
            $table->string('email2')->nullable();
            $table->string('email3', 20)->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('alamat_kantor', 50)->nullable();
            $table->string('postal', 10)->nullable();
            $table->string('telp', 20)->nullable();
            $table->string('fax', 20)->nullable();
            $table->string('ktp', 50)->nullable();
            $table->string('ktr', 50)->nullable();
            $table->string('tmt', 50)->nullable();
            $table->string('rmh', 50)->nullable();
            $table->string('kode_post', 50)->nullable();
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('proses', 2)->nullable();
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
        Schema::dropIfExists('users');
    }
}
