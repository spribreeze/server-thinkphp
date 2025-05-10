<?php

namespace app\model;

use think\Model;

class PostLike extends Model
{
    protected $name = 'post_like'; // 对应的表名
    public $autoWriteTimestamp = true;
    protected $createTime = 'created_at';

    /**
     * 关联用户模型
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }

    /**
     * 关联帖子模型
     */
    public function post()
    {
        return $this->belongsTo('Post', 'post_id', 'id');
    }
}