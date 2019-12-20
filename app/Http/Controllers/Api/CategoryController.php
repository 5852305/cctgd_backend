<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected  $category;

    public function __construct(Category $category)
    {
        $this->category= $category;
    }


    public function index(CategoryRequest $request)
    {
        $limit = $request->get("limit");
        $categorys=$this->category->paginate($limit ?? 15);
        return success("暂时没有分类数据",$categorys);
    }
    public function store(CategoryRequest $request)
    {
        $category=$this->category->create($request->all());
        return $category ? success("添加成功") : error("添加失败");
    }

    public function update(Request $request)
    {

    }
}
