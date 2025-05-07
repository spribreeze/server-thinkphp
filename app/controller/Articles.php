<?php

namespace app\controller;

use think\Request;
use app\model\Article;
use app\model\UserArticleFavorite;
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

        $items = [];
        $userId = $request->user['user_id'] ?? null;
        // 获取所有文章ID
        $articleIds = array_column($list->items(), 'id');

        // 查询这些文章哪些已经被当前用户收藏
        $favoritedArticles = [];
        if ($userId) {
            $favoritedArticles = UserArticleFavorite::where('user_id', $userId)
                ->whereIn('article_id', $articleIds)
                ->column('article_id');
        }
        
        // 查询每个商品的点赞数
        $favoriteCounts = UserArticleFavorite::whereIn('article_id', $articleIds)
            ->group('article_id')
            ->field('article_id, count(*) as favorite_count')
            ->select()
            ->toArray();
    
        // 将点赞数转换为关联数组，方便查找
        $favoriteCountMap = [];
        foreach ($favoriteCounts as $item) {
            $favoriteCountMap[$item['article_id']] = $item['favorite_count'];
        }

        // 处理返回的数据，添加 is_favorited 字段
        foreach ($list->items() as $item) {
            $items[] = array_merge(
                $item->toArray(),
                ['favorite_count' => $favoriteCountMap[$item->id] ?? 0], // 默认点赞数为0
                ['is_favorited' => in_array($item->id, $favoritedArticles)]
            );
        }

        return json([
            'code' => 200,
            'msg'  => 'success',
            'data' => [
                'items' => $items, // 当前页的数据
                'total' => $list->total(), // 总记录数
                'page'  => $list->currentPage(), // 当前页码
                'limit' => $list->listRows(),    // 每页条数
            ],
        ]);

    }
}