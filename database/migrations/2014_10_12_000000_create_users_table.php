<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('mobile')->unique();
            $table->string('password')->nullable();
            $table->boolean('gender')->nullable();
            $table->date('dob')->nullable();                                               
            $table->text('address')->nullable();
            $table->integer('age')->nullable();
            $table->integer('referred_by')->nullable();
            $table->bigInteger('membership_card_no')->nullable();
            $table->bigInteger('aadhar_card_no')->nullable();
            $table->boolean('member_type')->nullable();
            $table->string('profile_pic')->nullable();
            $table->ipAddress('login_ip')->nullable();
            $table->boolean('member_status')->default(0);
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
        Schema::dropIfExists('users');
    }
}
