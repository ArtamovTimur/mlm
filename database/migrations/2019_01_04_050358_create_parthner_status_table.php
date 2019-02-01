<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class CreateParthnerStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parthner_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('user_pv');
            $table->integer('group_pv');
            $table->integer('passive');
            $table->timestamps();
        });
        DB::table('parthner_status')->
            insert([
                ['title' => 'Star Manager', 'user_pv' => 50, 'group_pv' => 1500, 'passive' => 75],
                ['title' => 'Менеджер', 'user_pv' => 50, 'group_pv' => 5000, 'passive' => 175],
                ['title' => 'Бронзовый менеджер', 'user_pv' => 50, 'group_pv' => 15000, 'passive' => 500],
                ['title' => 'Серебрянный менеджер', 'user_pv' => 75, 'group_pv' => 3000, 'passive' => 750],
                ['title' => 'Золотой менеджер', 'user_pv' => 75, 'group_pv' => 5000, 'passive' => 1000],
                ['title' => 'Платиновый менеджер', 'user_pv' => 75, 'group_pv' => 10000, 'passive' => 2500],
                ['title' => 'Директор', 'user_pv' => 100, 'group_pv' => 20000, 'passive' => 5000],
                ['title' => 'Золотой директор', 'user_pv' => 100, 'group_pv' => 40000, 'passive' => 10000],
                ['title' => 'Сапфировый директор', 'user_pv' => 100, 'group_pv' => 80000, 'passive' => 20000],
                ['title' => 'Бриллиантовый директор', 'user_pv' => 150, 'group_pv' => 150000, 'passive' => 35000],
                ['title' => 'Член Лидеров Совета', 'user_pv' => 150, 'group_pv' => 300000, 'passive' => 75000],
                ['title' => 'Член Корпоративный Совета', 'user_pv' => 150, 'group_pv' => 500000, 'passive' => 100000]
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parthner_status');
    }
}
