<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InitController extends BaseController
{
    public function index()
    {
        return response()->json(file_get_contents(resource_path("js/api/init.json")));
    }
}
