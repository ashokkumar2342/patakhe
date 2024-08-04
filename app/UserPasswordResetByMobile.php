<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPasswordResetByMobile extends Model
{
    //
    protected $fillable=['user_id','mobile','otp','status'];
}
