<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowerSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FollowerSettings', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('userid');
            $table->string('tcolor');
            $table->string('bcolor');
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
        Schema::table('FollowerSettings', function (Blueprint $table) {
            //
        });
    }
}
