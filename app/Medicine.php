<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Medicine extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['user_id','name','mobile','file','status' ];
    public function user(){
    	return $this->belongsTo('App\User','user_id','id');
    }
}
