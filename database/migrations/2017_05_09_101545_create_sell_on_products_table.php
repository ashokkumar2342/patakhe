<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellOnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_on_products', function (Blueprint $table) {
            $table->increments('id');       
            $table->unsignedInteger('pid');
            $table->unsignedInteger('sid');     
            $table->string('sku')->nullable();
            $table->integer('msp');
            $table->integer('position')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->boolean('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sell_on_products');
    }
}
