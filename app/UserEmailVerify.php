<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class UserEmailVerify extends Model
{
    //
    protected $fillable = ['email','token','status'];
    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }

}
