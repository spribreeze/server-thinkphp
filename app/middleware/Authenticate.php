<?php

namespace app\middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use think\facade\Env;

class Authenticate
{
    public function handle($request, \Closure $next)
    {
        // 获取请求头中的 Token
        $token = $request->header('token');

        if (!$token) {
            return json(['code' => 401, 'msg' => '未提供 Token']);
        }

        try {
            $key = Env::get('JWT_SECRET_KEY');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            // 将解码后的用户信息存储到请求中
            $request->user = $decoded->data;
        } catch (\Exception $e) {
            return json(['code' => 401, 'msg' => '无效的 Token']);
        }

        return $next($request);
    }
}