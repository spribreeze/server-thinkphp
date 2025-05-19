<?php

namespace app\controller;

use think\Request;
use app\model\Product; // 商品模型
use app\model\UserFavorite;
use app\model\productType;
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
        $column02 = $request->param('type', ''); // 类型筛选

        // 构建查询条件
        // $query = Product::order('id', 'desc'); // 默认排序
        $query = Product::with(['images' => function($query){
            // 可以根据需要调整子查询逻辑
            $query->order('sort_order', 'asc'); // 按照排序顺序升序排列图片
        }])->order('id', 'desc');

        // 如果提供了关键字，则按名称或描述模糊匹配
        if (!empty($keyword)) {
            // $query->where('name|description', 'like', '%' . $keyword . '%');
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        // 如果提供了类型，则按类型精确匹配
        if (!empty($column02)) {
            // $query->where('column02', '=', $column02);
            $query->where('column02', 'like', '%' . $column02 . '%');
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
        $productId = $request->post('product_id', $request->post('productId', 0));
        
        if ($userId) {
            $result = $comment->save([
                'product_id' => $productId,
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
        // $productId = $request->param('productId', 0);
        $productId = $request->param('product_id', $request->param('productId', 0));


        $comments = ProductComment::with('user') // 自动带上用户信息（不包括密码）
            ->where('product_id', '=', $productId)
            ->order('created_at', 'desc')
            ->select();

        if ($comments) {
            return json([                
                'code' => 200,
                'msg' => '获取评论成功', 
                'data' => $comments
            ]);
        } else {
            return json(['status' => 'error', 'message' => '暂无评论'], 404);
        }
    }

    public function getDetail(Request $request)
    {
        // 获取商品ID，优先获取 product_id，其次 productId，最后默认为0
        $id = $request->param('product_id', $request->param('productId', 0));

        // 查询商品数据，并预加载 images 关联模型（按 sort_order 升序）
        $product = Product::with(['images' => function ($query) {
            $query->order('sort_order', 'asc');
        }])->find($id);

        if (empty($product)) {
            return json(['error' => 'Product not found'], 404);
        }

        // 转换为数组以便后续合并数据
        $productArray = $product->toArray();

        // 获取所有评论
        $comments = ProductComment::where('product_id', '=', $id)->select();
        $commentCount = count($comments);

        // 获取收藏数
        $favoriteCount = UserFavorite::where('product_id', '=', $id)->count();

        // 判断当前用户是否收藏了该商品
        $userId = $request->user['user_id'] ?? null;
        $isFavorited = false;
        if ($userId) {
            $isFavorited = UserFavorite::where('product_id', '=', $id)
                ->where('user_id', '=', $userId)
                ->count() > 0;
        }

        // 合并商品信息和扩展字段
        $mergedData = array_merge($productArray, [
            'comments'       => $comments,
            'comment_count'  => $commentCount,
            'favorite_count' => $favoriteCount,
            'is_favorited'   => $isFavorited,
        ]);

        // 返回标准 JSON 格式响应
        return json([
            'code' => 200,
            'msg'  => 'success',
            'data' => $mergedData,
        ]);
    }

    /**
     * 获取所有帖子类型
     *
     * @param Request $request
     * @return \think\Response
     */
    public function getProductsTypes(Request $request)
    {
        // 查询所有帖子类型，只取 name 字段并转为一维数组
        $types = productType::column('name');

        return json([
            'code' => 200,
            'msg'  => 'success',
            'data' => $types, // 直接返回纯字符串数组
        ]);
    }

    // 根据评论数和收藏数计算热度最高的前5个商品
    public function getTopHotProducts(Request $request)
    {
        // 查询条件：选择需要的字段，并通过子查询或联表查询获取评论数和收藏数
        $products = Product::field('p.*, 
            (SELECT COUNT(*) FROM product_comments WHERE product_id = p.id) AS comment_count,
            (SELECT COUNT(*) FROM user_favorites WHERE product_id = p.id) AS favorite_count')
            ->alias('p')
            ->with(['images' => function($query){
                $query->order('sort_order', 'asc');
            }])
            ->orderRaw('(comment_count * 1 + favorite_count * 2) DESC') // 根据你的需求调整权重
            ->limit(5)
            ->select();

        // 处理每个商品的数据
        $processedProducts = array_map(function($product) {
            $itemArray = is_array($product) ? $product : $product->toArray();

            // 初始化 cover_image 和 all_images
            $coverImage = '';
            $allImages = [];

            if (isset($itemArray['images']) && is_array($itemArray['images']) && count($itemArray['images']) > 0) {
                foreach ($itemArray['images'] as $image) {
                    if (isset($image['image_url'])) {
                        $allImages[] = $image['image_url'];
                        if (empty($coverImage)) {
                            $coverImage = $image['image_url'];
                        }
                    }
                }
            }

            return array_merge($itemArray, [
                'cover_image' => $coverImage,     // 添加首张图字段
                'all_images' => $allImages,       // 所有图片 URL 数组
            ]);
        }, $products->toArray());

        // 返回结果
        return json([
            'code' => 200,
            'msg' => 'success',
            'data' => $processedProducts
        ]);
    }

}