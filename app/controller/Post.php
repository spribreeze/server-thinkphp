<?php

namespace app\controller;

use think\Request;
use app\model\Post as modelPost;
use app\model\PostComment;
use app\model\PostLike;
use app\model\PostType;
use app\model\User;

class Post
{

    public function getDetail(Request $request)
    {
        // 获取帖子ID，优先获取 post_id，其次 postId，最后默认为0
        $id = $request->param('post_id', $request->param('postId', 0));

        // 查询帖子数据，并预加载 user 关联模型（获取发帖人信息）
        $post = modelPost::with(['user' => function ($query) {
            $query->field(['id', 'username', 'nickname', 'avatar_url']); // 只加载必要的字段
        }])->find($id);

        if (empty($post)) {
            return json(['error' => 'Post not found'], 404);
        }

        // 转换为数组以便后续合并数据
        $postArray = $post->toArray();

        // // 获取所有评论
        // $comments = PostComment::where('post_id', '=', $id)->select();
        // $commentCount = count($comments);
        // 查询评论数据，并预加载 user 关联模型（获取评论用户的用户名、昵称、头像）
            $comments = PostComment::with(['user' => function ($query) {
                $query->field(['id', 'username', 'nickname', 'avatar_url']);
            }])
            ->where('post_id', '=', $id)
            ->select();

            // 将评论数据转为数组，并提取用户信息
            $commentsArray = [];
            foreach ($comments as $comment) {
                $commentArray = $comment->toArray();
                $commentArray['user'] = $comment->user ? $comment->user->toArray() : null;
                $commentsArray[] = $commentArray;
            }

            $commentCount = count($commentsArray);

        // 获取点赞数
        $likeCount = PostLike::where('post_id', '=', $id)->count();

        // 判断当前用户是否已点赞该帖子
        $userId = $request->user['user_id'] ?? null;
        $isLiked = false;
        if ($userId) {
            $isLiked = PostLike::where('post_id', '=', $id)
                ->where('user_id', '=', $userId)
                ->count() > 0;
        }

        // 合并帖子信息和扩展字段
        $mergedData = array_merge($postArray, [
            'comments'      => $comments,
            'comment_count' => $commentCount,
            'favorite_count'    => $likeCount,
            'is_favorited'      => $isLiked,
        ]);

        // 返回标准 JSON 格式响应
        return json([
            'code' => 200,
            'msg'  => 'success',
            'data' => $mergedData,
        ]);
    }


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
        // 获取当前登录用户ID（假设通过中间件注入）
        $userId = $request->user['user_id'] ?? null;

        // 获取请求参数
        $page = $request->param('page', 1);         // 当前页码
        $limit = $request->param('limit', 10);       // 每页条数
        $keyword = $request->param('keyword', '');   // 标题/内容搜索
        $type = $request->param('type', '');         // 类型筛选
        $nickname = $request->param('nickname', ''); // 用户昵称搜索

        // 构建查询条件
        $query = modelPost::with(['user' => function($q) {
            $q->field(['id', 'username', 'nickname', 'avatar_url']); // 用户信息
        }])->order('post.id', 'desc'); // 指定 post.id 避免歧义

        // 关键字搜索（按标题或内容模糊匹配）
        if (!empty($keyword)) {
            $query->where('title|content', 'like', '%' . $keyword . '%');
        }

        // 类型筛选
        if (!empty($type)) {
            $query->where('type', '=', $type);
        }

        if (!empty($nickname)) {
            $query->join('users', 'post.user_id = users.id')
                ->where('users.nickname', 'like', '%' . $nickname . '%');
        }
        
        // 分页查询
        $list = $query->paginate([
            'list_rows' => $limit,
            'page'      => $page,
        ]);

        // 处理每条帖子的数据，追加点赞数、评论数、是否点赞
        $items = $list->items();

        foreach ($items as &$item) {
            // 帖子ID
            $postId = $item['id'];

            // 获取点赞数
            $likeCount = PostLike::where('post_id', $postId)->count();

            // 获取评论数
            $commentCount = PostComment::where('post_id', $postId)->count();

            // 判断当前用户是否点赞了该帖子
            $isLiked = false;
            if ($userId) {
                $isLiked = PostLike::where('user_id', $userId)
                                ->where('post_id', $postId)
                                ->find() ? true : false;
            }

            // 添加扩展字段
            $item['favorite_count'] = $likeCount;
            $item['comment_count'] = $commentCount;
            $item['is_favorited'] = $isLiked;
        }

        return json([
            'code' => 200,
            'msg'  => 'success',
            'data' => [
                'items' => $items,                   // 已增强的帖子列表数据
                'total' => $list->total(),           // 总记录数
                'page'  => $list->currentPage(),     // 当前页码
                'limit' => $list->listRows(),        // 每页条数
            ],
        ]);
    }

    /**
     * 用户评论帖子
     *
     * @param Request $request
     * @return \think\Response
     */
    public function commentPost(Request $request)
    {
        // 获取当前登录用户ID
        $userId = $request->user['user_id'] ?? null;
        if (!$userId) {
            return json(['code' => 401, 'msg' => '未登录']);
        }

        // 参数校验
        // $postId = $request->post('post_id/d', 0);
        $postId = $request->post('post_id', $request->post('postId', 0));
        $content = $request->post('content', '');

        if (empty($postId)) {
            return json(['code' => 400, 'msg' => '帖子ID不能为空']);
        }

        if (empty($content)) {
            return json(['code' => 400, 'msg' => '评论内容不能为空']);
        }

        // 创建评论
        $comment = new PostComment();
        $comment->post_id = $postId;
        $comment->user_id = $userId;
        $comment->content = $content;

        if ($comment->save()) {
            return json([
                'code' => 200,
                'msg' => '评论成功',
                'data' => [
                    'comment' => $comment->toArray()
                ]
            ]);
        } else {
            return json(['code' => 500, 'msg' => '评论失败']);
        }
    }

    /**
     * 获取帖子评论列表（支持分页）
     *
     * @param Request $request
     * @return \think\Response
     */
    public function getPostComments(Request $request)
    {
        // $postId = $request->get('post_id/d', 0);
        $postId = $request->param('post_id', $request->param('postId', 0));


        $page = $request->get('page/d', 1);
        $limit = $request->get('limit/d', 10);

        if (empty($postId)) {
            return json(['code' => 400, 'msg' => '帖子ID不能为空']);
        }

        // 查询评论
        $query = PostComment::with(['user' => function($q) {
            $q->field(['id', 'username', 'nickname','avatar_url']); // 加载用户信息
        }])->where('post_id', $postId)->order('id', 'desc');

        $comments = $query->paginate([
            'list_rows' => $limit,
            'page'      => $page,
        ]);

        return json([
            'code' => 200,
            'msg' => 'success',
            'data' => [
                'items' => $comments->items(),
                'total' => $comments->total(),
                'page' => $comments->currentPage(),
                'limit' => $comments->listRows(),
            ]
        ]);
    }

    /**
     * 用户点赞/取消点赞帖子
     *
     * @param Request $request
     * @return \think\Response
     */
    public function toggleLike(Request $request)
    {
        // 获取当前登录用户ID
        $userId = $request->user['user_id'] ?? null;
        if (!$userId) {
            return json(['code' => 401, 'msg' => '未登录']);
        }

        // 参数校验
        $postId = $request->post('post_id/d', 0);
        if (empty($postId)) {
            return json(['code' => 400, 'msg' => '帖子ID不能为空']);
        }

        // 检查是否已点赞
        $liked = PostLike::where('user_id', $userId)->where('post_id', $postId)->find();

        if ($liked) {
            // 如果已点赞，则取消点赞
            if ($liked->delete()) {
                return json([
                    'code' => 200,
                    'msg' => '取消点赞成功',
                    'data' => [
                        'liked' => false
                    ]
                ]);
            } else {
                return json(['code' => 500, 'msg' => '操作失败']);
            }
        } else {
            // 如果未点赞，则点赞
            $like = new PostLike();
            $like->user_id = $userId;
            $like->post_id = $postId;

            if ($like->save()) {
                return json([
                    'code' => 200,
                    'msg' => '点赞成功',
                    'data' => [
                        'liked' => true
                    ]
                ]);
            } else {
                return json(['code' => 500, 'msg' => '操作失败']);
            }
        }
    }

    /**
     * 获取用户点赞的帖子列表（支持分页）
     *
     * @param Request $request
     * @return \think\Response
     */
    public function getUserLikedPosts(Request $request)
    {
        // 获取当前登录用户ID
        $userId = $request->user['user_id'] ?? null;
        if (!$userId) {
            return json(['code' => 401, 'msg' => '未登录']);
        }

        $page = $request->get('page/d', 1);
        $limit = $request->get('limit/d', 10);

        // 查询点赞记录并关联帖子
        $query = PostLike::with(['post' => function($q) {
            $q->field(['id', 'title', 'type', 'created_at']); // 只加载必要的字段
        }])
        ->where('user_id', $userId)
        ->order('created_at', 'desc');

        $likes = $query->paginate([
            'list_rows' => $limit,
            'page'      => $page,
        ]);

        return json([
            'code' => 200,
            'msg' => 'success',
            'data' => [
                'items' => $likes->items(),
                'total' => $likes->total(),
                'page' => $likes->currentPage(),
                'limit' => $likes->listRows(),
            ]
        ]);
    }


    /**
     * 获取所有唯一的帖子类型（去重）
     *
     * @param Request $request
     * @return \think\Response
     */
    // public function getPostTypes(Request $request)
    // {
    //     // 查询并去重获取所有 type，并提取为一维数组
    //     $typeList = modelPost::distinct(true)
    //         ->whereNotNull('type')
    //         ->where('type', '<>', '')
    //         ->order('type', 'asc')
    //         ->column('type');

    //     return json([
    //         'code' => 200,
    //         'msg'  => 'success',
    //         'data' => $typeList
    //     ]);
    // }

    /**
     * 获取所有帖子类型
     *
     * @param Request $request
     * @return \think\Response
     */
    public function getPostTypes(Request $request)
    {
        // 查询所有帖子类型，只取 name 字段并转为一维数组
        $types = PostType::column('name');

        return json([
            'code' => 200,
            'msg'  => 'success',
            'data' => $types, // 直接返回纯字符串数组
        ]);
    }



    /**
     * 获取指定用户的帖子列表
     *
     * @param Request $request
     * @return \think\Response
     */
    public function getUserPosts(Request $request)
    {
        // 获取请求中的 user_id 参数
        $userId = $request->user['user_id'] ?? null;
        if (empty($userId)) {
            return json([
                'code' => 200,
                'msg'  => 'Missing user_id parameter',
                'data' => [],
            ]);
        }

        // 查询该用户的所有帖子，并按发布时间降序排列
        $posts = modelPost::with(['user' => function ($q) {
            $q->field(['id', 'username', 'nickname', 'avatar_url']); // 加载用户基础信息
        }])
        ->where('user_id', '=', $userId)
        ->order('created_at', 'desc')
        ->paginate([
            'list_rows' => 10, // 每页显示的帖子数量
            'query' => request()->param(), // 保持分页URL上的参数
        ]);

        // 处理每条帖子的数据，追加点赞数、评论数、是否点赞等信息
        $items = $posts->items();
        foreach ($items as &$item) {
            // 获取点赞数
            $likeCount = PostLike::where('post_id', $item['id'])->count();

            // 获取评论数
            $commentCount = PostComment::where('post_id', $item['id'])->count();

            // 添加扩展字段
            $item['favorite_count'] = $likeCount;
            $item['comment_count'] = $commentCount;
        }

        return json([
            'code' => 200,
            'msg'  => 'success',
            'data' => [
                'items' => $items,                   // 已增强的帖子列表数据
                'total' => $posts->total(),           // 总记录数
                'page'  => $posts->currentPage(),     // 当前页码
                'limit' => $posts->listRows(),        // 每页条数
            ],
        ]);
    }

    /**
     * 获取热度最高的前5个帖子（点赞数 + 评论数）
     *
     * @param Request $request
     * @return \think\Response
     */
    public function getTopHotPost(Request $request)
    {

        // 获取所有帖子 ID 列表
        $postIds = modelPost::column('id');

        if (empty($postIds)) {
            return json([
                'code' => 200,
                'msg' => 'success',
                'data' => [
                    'items' => []
                ]
            ]);
        }

        // 获取每个帖子的点赞数
        $likeCounts = PostLike::whereIn('post_id', $postIds)
            ->group('post_id')
            ->field('post_id, count(*) as like_count')
            ->select()
            ->toArray();

        // 获取每个帖子的评论数
        $commentCounts = PostComment::whereIn('post_id', $postIds)
            ->group('post_id')
            ->field('post_id, count(*) as comment_count')
            ->select()
            ->toArray();

        // 构建 post_id => count 映射
        $likesMap = array_column($likeCounts, 'like_count', 'post_id');
        $commentsMap = array_column($commentCounts, 'comment_count', 'post_id');

        // 查询所有帖子，并加载用户信息
        $posts = modelPost::with(['user' => function ($q) {
            $q->field(['id', 'username', 'nickname', 'avatar_url']);
        }])
            ->whereIn('id', $postIds)
            ->select()
            ->each(function ($post) use ($likesMap, $commentsMap) {
                // 设置点赞数和评论数
                $postId = $post->id;
                $post->like_count = $likesMap[$postId] ?? 0;
                $post->comment_count = $commentsMap[$postId] ?? 0;
                // 计算热度值
                $post->hot_score = $post->like_count + $post->comment_count;
            })
            ->toArray();
            
        // 使用 usort 手动按 hot_score 排序
        usort($posts, function ($a, $b) {
            return $b['hot_score'] <=> $a['hot_score'];
        });

        // 取前5个
        $top5 = array_slice($posts, 0, 5);

        return json([
            'code' => 200,
            'msg' => 'success',
            'data' => [
                'items' => $top5
            ]
        ]);

    }

}