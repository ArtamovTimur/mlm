<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinaryTreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binary_trees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hash');
            $table->string('parent_id');
            $table->integer('user_id');
            $table->integer('sponsor_id');
            $table->string('leg');
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
        Schema::dropIfExists('binary_trees');
    }
}
