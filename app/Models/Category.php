<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'parent_id','name', 'pic', 'head_pic','detail',
    ];
}
