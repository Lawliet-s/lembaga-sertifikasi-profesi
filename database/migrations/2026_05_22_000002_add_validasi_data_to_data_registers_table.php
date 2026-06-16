<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValidasiDataToDataRegistersTable extends Migration
{
    public function up()
    {
        Schema::table('data_registers', function (Blueprint $table) {
            $table->json('validasi_data')->nullable()->after('koreksi');
        });
    }

    public function down()
    {
        Schema::table('data_registers', function (Blueprint $table) {
            $table->dropColumn('validasi_data');
        });
    }
}
