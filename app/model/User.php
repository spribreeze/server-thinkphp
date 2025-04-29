<?php

namespace app\model;

use think\Model;

class User extends Model
{
    // 设置表名
    protected $table = 'users';

    // 设置主键
    protected $pk = 'id';
}