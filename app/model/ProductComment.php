<?php

namespace app\model;

use think\Model;

class ProductComment extends Model
{
    protected $name = 'product_comments'; // 对应数据表名

    // 定义与用户表的关联
    public function user()
    {
        return $this->belongsTo(\app\model\User::class, 'user_id', 'id');
    }
}