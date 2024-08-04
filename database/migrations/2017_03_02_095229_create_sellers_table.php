<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('mobile')->unique();
            $table->string('password');
            $table->boolean('gender')->nullable();
            $table->date('dob')->nullable(); 
            $table->text('address')->nullable();
            $table->integer('age')->nullable();
            $table->string('profile_pic')->nullable();
            $table->ipAddress('login_ip')->nullable();
            $table->boolean('mobile_verified')->default(0);
            $table->boolean('email_verified')->default(0);
            $table->timestampTz('login_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('sellers');
    }
}
