<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRekomendasiDataToDataRegistersTable extends Migration
{
    public function up()
    {
        Schema::table('data_registers', function (Blueprint $table) {
            $table->json('rekomendasi_data')->nullable()->after('validasi_data');
        });
    }

    public function down()
    {
        Schema::table('data_registers', function (Blueprint $table) {
            $table->dropColumn('rekomendasi_data');
        });
    }
}
