<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id','comments','status'];
    public function user(){
    	return $this->hasOne('App\User','id','user_id');
    }
    
}
