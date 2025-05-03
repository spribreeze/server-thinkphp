<?php

namespace app\model;

use think\Model;

class Product extends Model
{
    // 设置表名
    protected $table = 'products';

    // 设置主键
    protected $pk = 'id';

    // 定义与 ProductImage 的一对多关系
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}