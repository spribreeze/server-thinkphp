<?php

namespace app\controller;

use think\Request;
use app\model\Product; // 商品模型

class Products
{
    /**
     * 获取商品列表（分页）
     *
     * @param Request $request
     * @return \think\Response
     */
    public function getList(Request $request)
    {
        // 获取分页参数，默认每页显示 10 条数据
        $page = $request->param('page', 1); // 当前页码
        $limit = $request->param('limit', 10); // 每页条数

        // 查询商品表并分页
        $list = Product::where('status', 1) // 假设 status=1 表示有效商品
            ->order('id', 'desc')         // 按照 id 倒序排列
            ->paginate([
                'list_rows' => $limit,   // 每页条数
                'page'      => $page,    // 当前页码
            ]);

        // 返回分页数据
        return json([
            'code' => 200,
            'msg'  => 'success',
            'data' => [
                'items' => $list->items(), // 当前页的数据
                'total' => $list->total(), // 总记录数
                'page'  => $list->currentPage(), // 当前页码
                'limit' => $list->listRows(),    // 每页条数
            ],
        ]);
    }
}