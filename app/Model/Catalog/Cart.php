<?php

namespace App\Model\Catalog;

use Illuminate\Database\Eloquent\Model;
use Session;
class Cart 
{
    //
    public $items = null;

    public function  __construct($oldCart)
    {
        if ($oldCart) 
        {
            $this->items = $oldCart->items;
        }
    }
    public function add($pid, $qty,$sop,$iid) { 

        $storedItem = ['qty'=>$qty,  'sop'=>$sop, 'pid'=> $pid,'iid'=>$iid];           
        $this->items[$iid] = $storedItem;  
    } 
    public function remove($cart,$product) { 
       if(array_key_exists($product, $cart->items)) {
              return Session::pull('cart',$this->items[$product]);
        }  
    } 

}
