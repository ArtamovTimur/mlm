<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateInvoiceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean("active")->default(1);
            $table->timestamps();
        });

        DB::table('invoice_types')->insert([
            ['title' => 'Money invoice', 'active' => 1],
            ['title' => 'Deposit invoice', 'active' => 1],
            ['title' => 'Promotional invoice', 'active' => 1],
            ['title' => 'Bonuses invoice', 'active' => 1]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_types');
    }

}
