<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $totalCartPrice;
    public $totalCartQty;
    public function random_password($length){
    	$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    	$password = substr( str_shuffle( $chars ), 0, $length );
    	return $password;
    }
   
}
