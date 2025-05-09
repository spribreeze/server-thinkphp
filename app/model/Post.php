<?php

namespace app\model;

use think\Model;

class Post extends Model
{
    protected $name = 'post'; // 对应的表名
    public $autoWriteTimestamp = true; // 自动写入时间戳
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';

    /**
     * 定义与 User 模型的关联
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }    
}