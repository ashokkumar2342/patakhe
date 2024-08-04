<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LoginDetails extends Model
{
    //
    use SoftDeletes;
    public function admin(){
    	return $this->belongsTo('App\Admin','admin_id','id');
    }
    public function vendor(){
    	return $this->belongsTo('App\Vendor','vendor_id','id');
    }
    public function user(){
    	return $this->belongsTo('App\User','user_id','id');
    }
}
