<?php

namespace App\Http\Controllers\Api;

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
       $limit = $request->get("limit");
        $banners =  $this->banner->latest()->paginate($limit);
        return success("暂时没有轮播图数据",$banners);
    }
    //轮播图添加
    public function store(BannerRequest $request)
    {
        $banners=$this->banner->create($request->all());
        return $banners ? success("添加成功") : error("添加失败");
    }

  //轮播图修改
    public function update(BannerRequest $request,  Banner $banner)
    {
       $banners =  $banner->update($request->all());
      return $banners ? success("修改成功", $banners) : error("修改失败");
    }
   //轮播图删除
    public function destroy(BannerRequest $request,$id)
    {
         $del=$this->banner->whereIn('id',explode(",",$id))->delete();
         return $del ? success("删除成功") : error("删除失败");
    }
}
