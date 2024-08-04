<?php

namespace App\Model\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use SoftDeletes;
    public function productOnCategory(){
        return $this->hasMany('App\Model\Catalog\ProductOnCategory','cid','id');
    }
    public function childMenu(){
    	return $this->hasMany('App\Model\Catalog\Category','id','childrens');
    }
}
