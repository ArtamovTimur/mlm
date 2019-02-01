<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;
class CreateTarifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('pv');
            $table->integer('binary');
            $table->integer('referral_bonus');
            $table->integer('status_bonus');
            $table->integer('presentation_bonus');
            $table->integer('gift_bonus');
            $table->timestamps();
        });
        DB::table('tarifs')
            ->insert([
                [
                    'title' => 'P50',
                    'pv' => 50,
                    'binary' => 6,
                    'referral_bonus' => 8,
                    'status_bonus' => 0,
                    'presentation_bonus' => 0,
                    'gift_bonus' => 0
                ],
                [
                    'title' => 'P200',
                    'pv' => 200,
                    'binary' => 7,
                    'refreral_bonus' => 10,
                    'status_bonus' => 5,
                    'presentation_bonus' => 5,
                    'gift_bonus' => 5
                ],
                [
                    'title' => 'P500',
                    'pv' => 500,
                    'binary' => 8,
                    'referral_bonus' => 10,
                    'status_bonus' => 5,
                    'presentation_bonus' => 5,
                    'gift_bonus' => 5
                ],
                [
                    'title' => 'P750',
                    'pv' => 750,
                    'binary' => 10,
                    'referral_bonus' => 15,
                    'status_bonus' => 5,
                    'presentation_bonus' => 5,
                    'gift_bonus' => 5
                ],
                [
                    'title' => 'P1000',
                    'pv' => 1000,
                    'binary' => 10,
                    'referral_bonus' => 15,
                    'status_bonus' => 5,
                    'presentation_bonus' => 5,
                    'gift_bonus' => 5
                ]
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarifs');
    }
}
