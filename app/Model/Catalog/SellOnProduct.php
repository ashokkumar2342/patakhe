<?php

namespace App\Model\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SellOnProduct extends Model
{
    use SoftDeletes;
    protected $fillable = ['pid','stock','msp','sid','status'];
    public function details(){
    	return $this->belongsTo('App\Model\Catalog\Product','pid','id');    
    }
    public function product(){
    	return $this->belongsTo('App\Model\Catalog\Product','pid','id');
    }
    public function seller(){
    	return $this->hasOne('App\Seller','id','sid');
    }
}
