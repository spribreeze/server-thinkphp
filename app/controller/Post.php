<?php

namespace app\controller;

use think\Request;
use app\model\Post as modelPost;
use app\model\User;

class Post
{
    /**
     * 用户发布帖子接口
     *
     * @param Request $request
     * @return \think\Response
     */
    public function createPost(Request $request)
    {
        // 获取当前登录用户ID（假设已通过中间件注入）
        $userId = $request->user['user_id'] ?? null;

        if (!$userId) {
            return json(['code' => 401, 'msg' => '未登录']);
        }

        // 查询用户是否存在
        $user = User::find($userId);
        if (!$user) {
            return json(['code' => 403, 'msg' => '非法用户']);
        }

        // 获取请求参数
        $title = $request->post('title', '');
        $content = $request->post('content', '');
        $type = $request->post('type', '');

        // 参数校验
        if (empty($title)) {
            return json(['code' => 400, 'msg' => '标题不能为空']);
        }
        if (empty($content)) {
            return json(['code' => 400, 'msg' => '内容不能为空']);
        }

        // 创建新帖子
        $post = new modelPost();
        $post->user_id = $userId;
        $post->title = $title;
        $post->content = $content;
        $post->type = $type ?: null;

        if ($post->save()) {
            return json([
                'code' => 200,
                'msg' => '发布成功',
                'data' => [
                    'post' => $post->toArray()
                ]
            ]);
        } else {
            return json(['code' => 500, 'msg' => '发布失败']);
        }
    }

    /**
     * 获取帖子列表（分页、关键字搜索、类型筛选）
     *
     * @param Request $request
     * @return \think\Response
     */
    public function getPostList(Request $request)
    {
        // 获取请求参数
        $page = $request->param('page', 1);       // 当前页码
        $limit = $request->param('limit', 10);     // 每页条数
        $keyword = $request->param('keyword', ''); // 关键字搜索
        $type = $request->param('type', '');       // 类型筛选

        // 构建查询条件
        $query = modelPost::with(['user' => function($q) {
            $q->field(['id', 'username','userCol01']); // 可选：只加载用户名
        }])->order('id', 'desc');

        // 关键字搜索（按标题或内容模糊匹配）
        if (!empty($keyword)) {
            $query->where('title|content', 'like', '%' . $keyword . '%');
        }

        // 类型筛选
        if (!empty($type)) {
            $query->where('type', '=', $type);
        }

        // 分页查询
        $list = $query->paginate([
            'list_rows' => $limit,
            'page'      => $page,
        ]);

        return json([
            'code' => 200,
            'msg'  => 'success',
            'data' => [
                'items' => $list->items(),         // 当前页数据
                'total' => $list->total(),         // 总记录数
                'page'  => $list->currentPage(),   // 当前页码
                'limit' => $list->listRows(),      // 每页条数
            ],
        ]);
    }
}