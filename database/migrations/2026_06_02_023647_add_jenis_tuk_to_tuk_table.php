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
        Schema::table('tuk', function (Blueprint $table) {
            $table->string('jenis_tuk', 50)->nullable()->after('alamat');
        });
    }

    public function down()
    {
        Schema::table('tuk', function (Blueprint $table) {
            $table->dropColumn('jenis_tuk');
        });
    }
};
