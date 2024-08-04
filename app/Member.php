<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Member extends Model
{
    //
  	use SoftDeletes;
  	protected $fillable = ['user_id','member_type','membership_card_no','referred_by','status'];
    public function user(){
    	return $this->hasOne('App\User','id','user_id');
    }
    public function subMembers(){
    	return $this->hasMany('App\SubMember','member_id','id');
    }
    
    public function avilableUser(){
    	return $this->belongsToMany('App\User');
    }
}
