<?php

namespace App\Http\Controllers\Admin;
use App\Services\IndexServices;
use App\Http\Controllers\Controller;
class IndexController extends Controller
{
    public function __construct(IndexServices $indexServices)
    {

    }
    //后台首页列表
    public function index( )
    {
       return view('admin.indices.index');

    }
    //后台首页列表
    public function dashboard( )
    {
        return view('admin.indices.dashboard');

    }

}
