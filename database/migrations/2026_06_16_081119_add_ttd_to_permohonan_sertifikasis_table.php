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
        Schema::table('permohonan_sertifikasis', function (Blueprint $table) {
            $table->text('ttd')->nullable()->after('catatan');
        });
    }

    public function down()
    {
        Schema::table('permohonan_sertifikasis', function (Blueprint $table) {
            $table->dropColumn('ttd');
        });
    }
};
