<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constructions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('apply_for'); 
            $table->text('message')->nullable();                          
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
        Schema::dropIfExists('constructions');
    }
}
