<?php
// app/model/Article.php
namespace app\model;

use think\Model;

class Article extends Model
{
    protected $name = 'articles'; // 表名

    // app/model/Article.php
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'user_article_favorites', 'user_id', 'article_id');
    }
}