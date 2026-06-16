<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_dokumen')->nullable();
            $table->string('name');
            $table->bigInteger('data_register_id')->nullable()->index('upload_files_data_register_foreign');
            $table->bigInteger('user_id')->nullable();
            $table->string('status')->nullable();
            $table->string('y', 50)->nullable();
            $table->string('n', 50)->nullable();
            $table->string('z', 50)->nullable();
            $table->bigInteger('kode')->nullable();
            $table->string('koreksi', 225)->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('upload_files');
    }
}
