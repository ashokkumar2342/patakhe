<?php

namespace App\Model\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductOnCategory extends Model
{
    use SoftDeletes;
    public function product(){
    	return $this->hasOne('App\Model\Catalog\Product','id','pid');
    }
    public function sellOnProduct(){
    	return $this->belongsTo('App\Model\Catalog\sellOnProduct','pid','id');
    }
    public function category(){
    	return $this->hasOne('App\Model\Catalog\Category','id','cid');
    }
    
}
