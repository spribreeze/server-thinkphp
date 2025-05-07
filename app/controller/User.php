<?php

namespace app\controller;

use think\Request;
use app\model\UserFavorite;
use app\model\UserArticleFavorite;
use app\model\Product;
use app\model\Article;
use app\model\User as UserModel;

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

    // 获取用户收藏商品列表
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
    // 是否已收藏
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

    /**
     * 切换文章收藏状态（收藏/取消收藏）
     *
     * @param Request $request
     * @return \think\Response
     */
    public function toggleArticleFavorite(Request $request)
    {
        // 获取当前登录用户ID
        $userId = $request->user['user_id'];
        $articleId = $request->post('article_id');

        if (!$articleId) {
            return json(['code' => 400, 'msg' => '缺少文章ID']);
        }

        // 查询是否已收藏
        $exists = UserArticleFavorite::where([
            ['user_id', '=', $userId],
            ['article_id', '=', $articleId]
        ])->find();

        if ($exists) {
            // 已收藏，执行取消收藏
            $exists->delete();
            return json(['code' => 200, 'msg' => '取消收藏成功']);
        } else {
            // 未收藏，执行收藏
            UserArticleFavorite::create([
                'user_id' => $userId,
                'article_id' => $articleId
            ]);
            return json(['code' => 200, 'msg' => '收藏成功']);
        }
    }

    /**
     * 获取用户收藏的文章列表（分页）
     *
     * @param Request $request
     * @return \think\Response
     */
    public function getFavoriteArticles(Request $request)
    {
        // 获取当前登录用户ID
        $userId = $request->user['user_id']; // 假设通过中间件解析了 Token 并存入了 user 字段

        // 获取分页参数
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        // 查询用户的收藏文章
        $query = Article::alias('a')
            ->join('user_article_favorites uaf', 'a.id = uaf.article_id')
            ->where('uaf.user_id', '=', $userId);

        // 执行分页查询
        $list = $query->field('a.*') // 只选择文章表中的字段
            ->order('uaf.created_at', 'desc') // 按收藏时间降序排列
            ->paginate([
                'list_rows' => $limit,
                'page'      => $page,
            ]);

        // 返回结果
        return json([
            'code' => 200,
            'msg' => 'success',
            'data' => [
                'items' => $list->items(), // 当前页的数据
                'total' => $list->total(), // 总记录数
                'page'  => $list->currentPage(), // 当前页码
                'limit' => $list->listRows(),    // 每页条数
            ],
        ]);
    }

    /**
     * 更新用户信息
     *
     * @param Request $request
     * @return \think\Response
     */
    public function updateProfile(Request $request)
    {
        // 获取当前登录用户ID（这里假设你已经通过某种方式获取到了当前用户的信息）
        $userId = $request->user['user_id'] ?? null;

        if (!$userId) {
            return json(['code' => 401, 'msg' => '未授权，请先登录']);
        }

        // 查询当前用户
        $user = UserModel::find($userId);

        if (!$user) {
            return json(['code' => 404, 'msg' => '用户不存在']);
        }

        // 获取请求参数并仅在非空时更新
        $updates = [];

        $nickname = $request->post('nickname', '');
        if (!empty($nickname)) {
            $updates['nickname'] = $nickname;
        }

        $email = $request->post('email', '');
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $updates['email'] = $email;
        } elseif (!empty($email)) {
            return json(['code' => 400, 'msg' => '邮箱格式不正确']);
        }

        $phone = $request->post('phone', '');
        if (!empty($phone)) {
            $updates['phone'] = $phone;
        }

        $userCol01 = $request->post('userCol01', '');
        if (!empty($userCol01)) {
            $updates['userCol01'] = $userCol01;
        }

        $userCol02 = $request->post('userCol02', '');
        if (!empty($userCol02)) {
            $updates['userCol02'] = $userCol02;
        }
        $userCol03 = $request->post('userCol03', '');
        if (!empty($userCol03)) {
            $updates['userCol03'] = $userCol03;
        }
        $userCol04 = $request->post('userCol04', '');
        if (!empty($userCol04)) {
            $updates['userCol04'] = $userCol04;
        }
        $userCol05 = $request->post('userCol05', '');
        if (!empty($userCol05)) {
            $updates['userCol05'] = $userCol05;
        }
        $userCol06 = $request->post('userCol06', '');
        if (!empty($userCol06)) {
            $updates['userCol06'] = $userCol06;
        }
        $userCol07 = $request->post('userCol07', '');
        if (!empty($userCol07)) {
            $updates['userCol07'] = $userCol07;
        }
        $userCol08 = $request->post('userCol08', '');
        if (!empty($userCol08)) {
            $updates['userCol08'] = $userCol08;
        }
        $userCol09 = $request->post('userCol09', '');
        if (!empty($userCol09)) {
            $updates['userCol09'] = $userCol09;
        }

        // 如果没有需要更新的字段
        if (empty($updates)) {
            return json(['code' => 400, 'msg' => '没有有效的更新数据']);
        }

        if ($user->save($updates)) {
            return json([
                'code' => 200,
                'msg'  => '更新成功',
                'data' => [
                    'user' => $user->hidden(['password'])->toArray(), // 将用户模型转为数组，返回全部字段
                ]
            ]);
        } else {
            return json(['code' => 500, 'msg' => '更新失败，请稍后再试']);
        }
    }

}