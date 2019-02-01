<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class CreateBonusTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('bonus_count');
            $table->timestamps();
        });

        DB::table('bonus_types')
            ->insert([
                ['title' => 'Бонус Лидерский', 'bonus_count' => 10],
                ['title' => 'Бонус Склад', 'bonus_count' => 5],
                ['title' => 'Бонус за офис', 'bonus_count' => 4]
            ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonus_types');
    }
}
