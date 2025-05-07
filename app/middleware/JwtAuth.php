<?php

namespace app\middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use think\facade\Request;
use think\Response;

class JwtAuth
{
    protected $jwtKey = '5f4dcc3b5aa765d61d8327deb882cf99a1b3c7b2e5d5f0a3c7a1b4c8e9d7f123'; // 替换为你的密钥

    public function handle($request, \Closure $next)
    {
        $token = $request->header('token');

        if (!$token) {
            return Response::create(['code' => 401, 'msg' => '未提供 Token'], 'json')->code(401);
        }

        try {
            $token = str_replace('Bearer ', '', $token);
            $decoded = JWT::decode($token, new Key($this->jwtKey, 'HS256'));

            // ✅ 修改这里：正确从 data 中取出 user_id
            if (!isset($decoded->data->user_id)) {
                return Response::create(['code' => 401, 'msg' => 'Token 数据不完整'], 'json')->code(401);
            }

            // 将用户 ID 存入请求对象
            $request->user = [
                'user_id' => $decoded->data->user_id,
                // 其他字段也可以添加进来
            ];

        } catch (\Exception $e) {
            return Response::create(['code' => 401, 'msg' => '无效的 Token'], 'json')->code(401);
        }

        return $next($request);
    }
}