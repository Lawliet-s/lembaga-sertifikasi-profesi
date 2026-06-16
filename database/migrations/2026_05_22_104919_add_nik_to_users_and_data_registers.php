<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik', 50)->nullable()->unique()->after('name');
            $table->string('email', 255)->change();
        });

        Schema::table('data_registers', function (Blueprint $table) {
            $table->string('nik', 50)->nullable()->after('nim');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nik');
            $table->string('email', 20)->change();
        });

        Schema::table('data_registers', function (Blueprint $table) {
            $table->dropColumn('nik');
        });
    }
};
