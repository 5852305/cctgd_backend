<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MessageException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends BaseController
{
    public function uploadImages(Request $request)
    {

            $suffix=$request->file('image')->getClientOriginalExtension();
            $fileName=$request->file('image')->getClientOriginalName();
            $imageName=str_replace('.'.$suffix,'',$fileName);
            $path['name']=$imageName;
            $path['url']= $request->file('image')->store( 'files_images/'.date('Y-m-d',time()), 'public');
            return success("上传成功",$path);
    }
}
