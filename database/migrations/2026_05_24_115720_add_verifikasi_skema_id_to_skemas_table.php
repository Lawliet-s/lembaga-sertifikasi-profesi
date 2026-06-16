<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skemas', function (Blueprint $table) {
            $table->unsignedBigInteger('verifikasi_skema_id')->nullable()->after('status_id');
        });
    }

    public function down()
    {
        Schema::table('skemas', function (Blueprint $table) {
            $table->dropColumn('verifikasi_skema_id');
        });
    }
};
