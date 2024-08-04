<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SalesTaxRegistration extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['user_id','status'];
    public function user(){
    	return $this->belongsTo('App\User','user_id','id');
    }
}
