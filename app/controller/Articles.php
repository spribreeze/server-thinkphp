<?php

namespace app\controller;

use think\Request;
use app\model\Article;

class Articles
{
    /**
     * 获取文章列表（分页、关键字查询、类型查询）
     *
     * @param Request $request
     * @return \think\Response
     */
    public function getList(Request $request)
    {
        // 获取请求参数
        $page = $request->param('page', 1); // 当前页码
        $limit = $request->param('limit', 10); // 每页条数
        $keyword = $request->param('keyword', ''); // 关键字搜索
        $type = $request->param('type', ''); // 类型筛选

        // 构建查询条件
        $query = Article::order('publish_time', 'desc'); // 默认按发布时间降序排序

        // 如果提供了关键字，则按标题或内容模糊匹配
        if (!empty($keyword)) {
            $query->where('title|content', 'like', '%' . $keyword . '%');
        }

        // 如果提供了类型，则按类型精确匹配
        if (!empty($type)) {
            $query->where('type', '=', $type);
        }

        // 执行分页查询
        $list = $query->paginate([
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