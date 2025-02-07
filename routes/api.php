<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function($api) {
    $api->get('/init','InitController@index');
    $api->POST('/uploadImages', 'UploadController@uploadImages');
    $api->resource("category","CategoryController",["only"=>["index","store","update","destroy"]]);






   /*-----------------------------轮播图-----------------------------*/
   $api->resource('banners', 'BannerController', ['only' => ['index', 'store', 'update', 'destroy']]);

   /*-----------------------------轮播图-----------------------------*/
   $api->resource('banners', 'BannerController', ['only' => ['index', 'store', 'update', 'destroy']]);

   /*-----------------------------轮播图-----------------------------*/
   $api->resource('banners', 'BannerController', ['only' => ['index', 'store', 'update', 'destroy']]);
/*-*/
});
