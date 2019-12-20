<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Admin', 'prefix' => env('ROUTE_FREFIX'), 'as' => 'admin.', 'middleware' => []], function ($router) {
   /*-----------------------------后台首页-----------------------------*/
    $router->get('/', 'IndexController@index'); //主页
    $router->get('/dashboard', 'IndexController@dashboard')->name("dashboard");
    $router->get('/category', 'CategoryController@index')->name("category.index");

   /*-*/
});
