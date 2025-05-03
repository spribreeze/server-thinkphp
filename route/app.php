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
use app\middleware\JwtAuth;
use app\middleware\JwtAuthNotReturn;

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

// 收藏/取消收藏商品
Route::post('user/favorite/products/toggle', 'User/toggleFavorite')->middleware(JwtAuth::class);
// 获取用户收藏商品列表
Route::get('user/favorite/products/list', 'User/getFavoriteList')->middleware(JwtAuth::class);
// 判断某个商品是否已被当前用户收藏
Route::get('user/favorite/products/check', 'User/isFavorited')->middleware(JwtAuth::class);

// 文章列表接口
Route::get('articles/getList', 'Articles/getList')->middleware(JwtAuthNotReturn::class);
// 用户收藏或取消收藏文章接口
Route::post('user/favorite/article/toggle', 'User/toggleArticleFavorite')->middleware(JwtAuth::class);
// 获取用户收藏的文章列表
Route::get('user/favorite/article/list', 'User/getFavoriteArticles')->middleware(JwtAuth::class);