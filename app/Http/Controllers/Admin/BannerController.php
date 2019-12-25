<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BannerRequest;
use App\Http\Requests\Request;
use App\Services\BannerServices;
use App\Models\Banner;
use App\Http\Controllers\Controller;
class BannerController extends Controller
{
    protected $banner;
    protected $bannerServices;
    public function __construct(Banner $banner,BannerServices $bannerServices)
    {
        $this->banner= $banner;
        $this->bannerServices= $bannerServices;
    }
    //轮播图列表
    public function index(Request $request)
    {
       return view('admin.banners.index');

    }

}
