<?php

namespace app\model;

use think\Model;

class Product extends Model
{
    // 设置表名
    protected $table = 'products';

    // 设置主键
    protected $pk = 'id';
}