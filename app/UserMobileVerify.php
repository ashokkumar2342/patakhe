<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class UserMobileVerify extends Model
{
    //
    protected $fillabel = ['user_id','mobile','confirmation_code','status'];
    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
}
