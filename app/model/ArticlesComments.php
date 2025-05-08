<?php
namespace app\model;

use think\Model;

class ArticlesComments extends Model
{
    // 设置对应的表名
    protected $table = 'articles_comments';

    // 定义与用户表的关联
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}