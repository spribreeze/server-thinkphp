<?php

namespace app\model;

use think\Model;

class User extends Model
{
    // 设置表名
    protected $table = 'users';

    // 设置主键
    protected $pk = 'id';

    // 隐藏字段（自动过滤不返回）
    protected $hidden = ['password'];

    public function favoriteArticles()
    {
        return $this->belongsToMany(Article::class, 'user_article_favorites', 'article_id', 'user_id');
    }
}