<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

// 测试接口
Route::get('think', function () {
    return 'hello,ThinkPHP8!';
});
Route::get('hello/:name', 'index/hello');

// 用户注册接口
Route::post('auth/register', 'Auth/register');
// 用户登录接口
Route::post('auth/login', 'Auth/login');

// 商品列表分页接口
Route::get('products/getList', 'Products/getList');
// 商品列表分页接口（需要登录）
// Route::get('products/getList', 'Products/getList')->middleware(\app\middleware\Authenticate::class);


// 图片上传接口
Route::post('upload/image', 'Upload/uploadImage');