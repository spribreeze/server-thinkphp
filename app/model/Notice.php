<?php
// app/model/Article.php
namespace app\model;

use think\Model;

class Notice extends Model
{
    protected $name = 'notice'; // 表名

    // 设置主键
    protected $pk = 'id';
}