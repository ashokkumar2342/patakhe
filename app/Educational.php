<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Educational extends Model
{
	use SoftDeletes;
    protected $fillable = ['user_id','apply_for','message','status'];
    public function user(){
    	return $this->belongsTo('App\User','user_id','id');
    }
    
}
