<?php

namespace App\Model\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Order extends Model
{
    //
    use SoftDeletes;
    public function user(){
    	return $this->belongsTo('App\User','user_id','id');
    }
    public function orderItems(){
    	return $this->hasMany('App\Model\Catalog\OrderItem','order_id','id');
    }
    public function orderStatus(){
    	return $this->hasOne('App\Model\Catalog\OrderStatus','id','status');
    }

}
