<?php

namespace app\controller;

use think\Request;
use app\model\UserFavorite;
use app\model\Product;

class User
{
    /**
     * 切换收藏状态（收藏/取消收藏）
     *
     * @param Request $request
     * @return \think\Response
     */
    public function toggleFavorite(Request $request)
    {
        // 获取当前登录用户ID（假设你已经在中间件中解析了Token）
        // $userId = $request->user->user_id; // 根据你的 Token 解码逻辑调整
        $userId = $request->user['user_id'];
        $productId = $request->post('product_id');

        if (!$productId) {
            return json(['code' => 400, 'msg' => '缺少商品ID']);
        }

        // 查询是否已收藏
        $exists = UserFavorite::where([
            ['user_id', '=', $userId],
            ['product_id', '=', $productId]
        ])->find();

        if ($exists) {
            // 已收藏，执行取消收藏
            $exists->delete();
            return json(['code' => 200, 'msg' => '取消收藏成功']);
        } else {
            // 未收藏，执行收藏
            UserFavorite::create([
                'user_id' => $userId,
                'product_id' => $productId
            ]);
            return json(['code' => 200, 'msg' => '收藏成功']);
        }
    }

    // 获取用户收藏列表
    public function getFavoriteList(Request $request)
    {
        // 获取当前登录用户ID
        // $userId = $request->user->user_id; // 根据实际 Token 解析出的字段修改
        $userId = $request->user['user_id'];
        // 获取分页与搜索参数
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $keyword = $request->get('keyword', '');
    
        // 构建查询条件
        $query = Product::alias('p')
            ->join('user_favorites f', 'p.id = f.product_id')
            ->where('f.user_id', $userId);
    
        // 关键字搜索
        if (!empty($keyword)) {
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery->where('p.name|p.description', 'like', "%$keyword%");
            });
        }
    
        // 执行分页查询
        $list = $query->field('p.*')
            ->order('f.created_at', 'desc')
            ->paginate([
                'list_rows' => $limit,
                'page'      => $page,
            ]);
    
        // 返回结果
        return json([
            'code' => 200,
            'msg' => 'success',
            'data' => [
                'items' => $list->items(),
                'total' => $list->total(),
                'page'  => $list->currentPage(),
                'limit' => $list->listRows(),
            ]
        ]);
    }
    // GET /user/favorite/check?product_id=10
    public function isFavorited(Request $request)
    {
        $userId = $request->user['user_id'];
        $productId = $request->get('product_id');

        // 查询是否已收藏
        $exists = UserFavorite::where([
            ['user_id', '=', $userId],
            ['product_id', '=', $productId]
        ])->find();

        return json([
            'code' => 200,
            'data' => [
                'is_favorited' => !!$exists
            ]
        ]);
    }
}