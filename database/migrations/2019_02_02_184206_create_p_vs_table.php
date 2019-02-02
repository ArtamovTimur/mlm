<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePVsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_vs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('personal_pv');
            $table->integer('group_pv');
            $table->integer('not_activated_pv');
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
        Schema::dropIfExists('p_vs');
    }
}
