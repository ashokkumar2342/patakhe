<?php

namespace App\Model\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductImage extends Model
{
    use SoftDeletes;
    protected $fillable = ['pid'];
}
