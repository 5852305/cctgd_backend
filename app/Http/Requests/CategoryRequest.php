<?php

namespace App\Http\Requests;
class CategoryRequest extends Request
{
  public function attributes()
    {
        return [
            'name'=>'分类名',
            'pic'=>'封面',
            'head_pic' => '“副封面',
            'detail' => '描述',
        ];
    }
   public function rules()
    {
    switch($this->method())
           {
               // CREATE
               case 'POST':
               {
                   return [
                       'name'=>'required|unique:categories',
                       'pic'=>'required',
                       'head_pic' => 'required',
                       'detail' => 'required',
                   ];
               }
               // UPDATE
               case 'PUT':
               case 'PATCH':
               {

                   return [
                       'name'=>'required|unique:categories,name,'.$this->route('category'),
                       'pic'=>'required',
                       'head_pic' => 'required',
                       'detail' => 'required',
                   ];
               }
               case 'GET':
               case 'DELETE':
               default:
               {
                   return [];
               };
           }

       }

       public function messages()
       {
           return [
               'name.required' => '分类名不能为空！',
               'name.unique' => '分类名已存在！',
               'pic.required' => '封面必须上传！',
               'head_pic.required' => '副封面必须上传！',
               'detail.required' => '详情不能为空！',
           ];
       }

}
