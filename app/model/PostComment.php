<?php

namespace app\model;

use think\Model;

class PostComment extends Model
{
    protected $name = 'post_comment'; // 对应的表名
    public $autoWriteTimestamp = true;
    protected $createTime = 'created_at';

    /**
     * 关联用户模型
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }
}