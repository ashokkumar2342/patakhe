<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SellerEmailVerify extends Model
{
    //
    use SoftDeletes;
    public $incrementing = false;
    protected $fillable = ['email','token','status'];
}
