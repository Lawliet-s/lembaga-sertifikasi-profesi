<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToXnxxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('xnxxes', function (Blueprint $table) {
            $table->foreign(['data_register_id'])->references(['id'])->on('data_registers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('xnxxes', function (Blueprint $table) {
            $table->dropForeign('xnxxes_data_register_id_foreign');
        });
    }
}
