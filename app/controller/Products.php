<?php

namespace app\controller;

use think\Request;
use app\model\Product; // 商品模型
use app\model\UserFavorite;
use app\model\ProductComment;

class Products
{
    /**
     * 获取商品列表（分页、关键字搜索、类型筛选）
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
        // $query = Product::order('id', 'desc'); // 默认排序
        $query = Product::with(['images' => function($query){
            // 可以根据需要调整子查询逻辑
            $query->order('sort_order', 'asc'); // 按照排序顺序升序排列图片
        }])->order('id', 'desc');

        // 如果提供了关键字，则按名称或描述模糊匹配
        if (!empty($keyword)) {
            $query->where('name|description', 'like', '%' . $keyword . '%');
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
    
        // 获取所有商品ID
        $productIds = array_column($list->items(), 'id');
    
        // 查询这些商品哪些已经被当前用户收藏
        $favoritedProducts = [];
        if ($userId) {
            $favoritedProducts = UserFavorite::where('user_id', $userId)
                ->whereIn('product_id', $productIds)
                ->column('product_id');
        }
    
        // 查询每个商品的点赞数
        $favoriteCounts = UserFavorite::whereIn('product_id', $productIds)
            ->group('product_id')
            ->field('product_id, count(*) as favorite_count')
            ->select()
            ->toArray();
    
        // 将点赞数转换为关联数组，方便查找
        $favoriteCountMap = [];
        foreach ($favoriteCounts as $item) {
            $favoriteCountMap[$item['product_id']] = $item['favorite_count'];
        }
    
        // 处理返回的数据，添加 is_favorited 和 favorite_count 字段
        foreach ($list->items() as $item) {
            $items[] = array_merge(
                $item->toArray(),
                ['is_favorited' => in_array($item->id, $favoritedProducts)],
                ['favorite_count' => $favoriteCountMap[$item->id] ?? 0], // 默认点赞数为0
                ['images' => $item->images->toArray()] // 添加图片数组
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

    // 添加商品评论
    public function addComment(Request $request)
    {
        $data = $request->post();
        $comment = new ProductComment();

        $userId = $request->user['user_id'] ?? null;

        if ($userId) {
            $result = $comment->save([
                'product_id' => $data['product_id'],
                'user_id' => $userId,
                'content' => $data['content']
            ]);
    
            if ($result) {
                return json(['status' => 'success', 'message' => '评论成功']);
            } else {
                return json(['status' => 'error', 'message' => '评论失败'], 500);
            }
        }else{
            return json(['status' => 'error', 'message' => '获取商品id失败'], 500);
        }

    }

    // 获取商品的所有评论
    public function getCommentsByProductId(Request $request)
    {
        $productId = $request->param('productId', 0);

        $comments = ProductComment::with('user') // 自动带上用户信息（不包括密码）
            ->where('product_id', '=', $productId)
            ->order('created_at', 'desc')
            ->select();

        if ($comments) {
            return json(['status' => 'success', 'data' => $comments]);
        } else {
            return json(['status' => 'error', 'message' => '暂无评论'], 404);
        }
    }

}