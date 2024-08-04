<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminActivity extends Model
{
    //
    protected $fillable = ['admin_id','data_id','table_id','activity'];
}
