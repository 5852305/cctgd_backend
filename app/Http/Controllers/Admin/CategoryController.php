<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //分类列表
    public function index( )
    {
        return view('admin.category.index');

    }
}
