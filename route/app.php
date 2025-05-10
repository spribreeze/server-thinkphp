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
Route::get('/', function () {
    return 'hello,ThinkPHP8!';
});
Route::get('think', function () {
    return 'hello,ThinkPHP8!';
});
Route::get('hello/:name', 'index/hello');

// 用户注册接口
Route::post('auth/register', 'Auth/register');
// 用户登录接口
Route::post('auth/login', 'Auth/login');
// 更新用户信息
Route::post('user/updateProfile', 'User/updateProfile')->middleware(JwtAuth::class);
// 修改密码接口（需登录）
Route::post('auth/changePassword', 'Auth/changePassword')->middleware(JwtAuthNotReturn::class);
// 修改密码接口（无需登录）
Route::post('auth/resetPasswordByAccount', 'Auth/resetPasswordByAccount');

// 商品列表分页接口
Route::get('products/getList', 'Products/getList')->middleware(JwtAuthNotReturn::class);
// 商品评论
Route::post('products/addComment', 'products/addComment')->middleware(JwtAuth::class);
// 获取商品评论
Route::get('products/getComments', 'products/getCommentsByProductId');
// 收藏/取消收藏商品
Route::post('user/favorite/products/toggle', 'User/toggleFavorite')->middleware(JwtAuth::class);
// 获取用户收藏商品列表
Route::get('user/favorite/products/list', 'User/getFavoriteList')->middleware(JwtAuth::class);
// 判断某个商品是否已被当前用户收藏
Route::get('user/favorite/products/check', 'User/isFavorited')->middleware(JwtAuth::class);

// 文章列表接口
Route::get('articles/getList', 'Articles/getList')->middleware(JwtAuthNotReturn::class);
// 文章评论
Route::post('articles/addComment', 'articles/addComment')->middleware(JwtAuth::class);
// 获取文章评论
Route::get('articles/getComments', 'articles/getCommentsByArticleId');
// 用户收藏或取消收藏文章接口
Route::post('user/favorite/article/toggle', 'User/toggleArticleFavorite')->middleware(JwtAuth::class);
// 获取用户收藏的文章列表
Route::get('user/favorite/article/list', 'User/getFavoriteArticles')->middleware(JwtAuth::class);

// 图片上传接口
Route::post('upload/image', 'Upload/uploadImage');
// 获取公告列表
Route::post('notice/getList', 'Notice/getList');


// 发布帖子
Route::post('post/create', 'Post/createPost')->middleware(JwtAuth::class);
// 获取帖子列表
Route::get('post/list', 'Post/getPostList');
// 帖子发布评论
Route::post('post/addComment', 'Post/commentPost')->middleware(JwtAuth::class);
// 获取帖子评论
Route::get('post/getComments', 'Post/getPostComments');
// 点赞/取消点赞帖子
Route::post('post/toggleLike', 'Post/toggleLike')->middleware(JwtAuth::class);
// 获取用户点赞的帖子列表
Route::get('post/getUserLikedPosts', 'Post/getUserLikedPosts')->middleware(JwtAuth::class);
