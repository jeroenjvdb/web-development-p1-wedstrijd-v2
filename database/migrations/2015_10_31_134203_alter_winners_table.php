<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('winners', function($table) {
            $table->integer('date_id')->unsigned();
            $table->foreign('date_id')->references('id')->on('dates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('winners', function($table) {
            $table->dropForeign('winners_date_id_foreign');
            $table->dropColumn('date_id');
        });
    }
}
