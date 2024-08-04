<?php

namespace App\Model\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductItem extends Model
{
    use SoftDeletes;
    public function image(){
    	return $this->hasMany('App\Model\Catalog\ProductItemImage','iid','id');
    }
    public function unit(){
    	return $this->hasOne('App\Model\Catalog\Unit','id','unit_id');
    }
    public function saleUnit(){
    	return $this->hasOne('App\Model\Catalog\Unit','id','sale_unit_id');
    }
    public function colors(){
        return $this->hasMany('App\Model\Catalog\ProductItemColors','iid','id');
    }
    public function sellOnProduct(){
        return $this->hasOne('App\Model\Catalog\SellOnProduct','iid','id');
    }
}
