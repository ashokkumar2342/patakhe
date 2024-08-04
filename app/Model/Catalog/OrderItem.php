<?php

namespace App\Model\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OrderItem extends Model
{
    use SoftDeletes;
    public function order(){
    	return $this->hasOne('App\Model\Catalog\Order','id','order_id');
    }
    public function orderStatus(){
    	return $this->hasOne('App\Model\Catalog\OrderStatus','id','status');
    }
}
