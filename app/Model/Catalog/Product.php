<?php

namespace App\Model\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['status','pid','sid'];
    public function image(){
    	return $this->hasMany('App\Model\Catalog\ProductImage','pid','id');
    }
    public function productOnCategory(){
    	return $this->hasMany('App\Model\Catalog\ProductOnCategory','pid','id');
    }
    public function productItem(){
        return $this->hasMany('App\Model\Catalog\ProductItem','pid','id');
    }
    
   
    

}
