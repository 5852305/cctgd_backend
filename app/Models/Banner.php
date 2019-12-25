<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//轮播图Model
class Banner extends Model
{

   use SoftDeletes;
   protected $casts=[];
   protected $fillable=[];
}
