<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class MemberRequest extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['user_id','status'];
    public function UserDetails(){
    	return $this->belongsTo('App\User','user_id','id');
    }
    public function avilableUser(){
    	return $this->belongsToMany('App\User');
    }
}
