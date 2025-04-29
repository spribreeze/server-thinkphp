<?php

namespace app\controller;

use think\Request;
use app\model\User;
use Firebase\JWT\JWT;
use think\facade\Env;

class Auth
{
    /**
     * 用户注册接口
     *
     * @param Request $request
     * @return \think\Response
     */
    public function register(Request $request)
    {
        // 获取请求参数
        $username = $request->post('username');
        $password = $request->post('password');

        // 参数校验
        if (empty($username) || empty($password)) {
            return json(['code' => 400, 'msg' => '用户名或密码不能为空']);
        }

        // 检查用户名是否已存在
        $exists = User::where('username', $username)->find();
        if ($exists) {
            return json(['code' => 400, 'msg' => '用户名已存在']);
        }

        // 密码复杂度校验（可选）
        if (strlen($password) < 6) {
            return json(['code' => 400, 'msg' => '密码长度不能小于6位']);
        }

        // 密码加密
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // 插入用户数据
        $user = new User();
        $user->username = $username;
        $user->password = $hashedPassword;

        if ($user->save()) {
            // return json(['code' => 200, 'msg' => '注册成功']);
            return json([
                'code' => 200,
                'msg'  => '注册成功',
                'data' => [
                    'user_id' => $user->id,
                    'username' => $user->username,
                ],
            ]);
        } else {
            return json(['code' => 500, 'msg' => '注册失败，请稍后再试']);
        }
    }

    /**
     * 用户登录接口
     *
     * @param Request $request
     * @return \think\Response
     */
    public function login(Request $request)
    {
        // 获取请求参数
        $username = $request->post('username');
        $password = $request->post('password');

        // 参数校验
        if (empty($username) || empty($password)) {
            return json(['code' => 400, 'msg' => '用户名或密码不能为空']);
        }

        // 查询用户
        $user = User::where('username', $username)->find();

        if (!$user) {
            return json(['code' => 401, 'msg' => '用户名不存在']);
        }

        // 验证密码
        if (!password_verify($password, $user->password)) {
            return json(['code' => 401, 'msg' => '密码错误']);
        }

        // 登录成功，生成 JWT Token
        $key = Env::get('JWT_SECRET_KEY'); //密钥
        $payload = [
            'iss' => 'your_issuer',       // 签发者
            'aud' => 'your_audience',     // 接收者
            'iat' => time(),              // 签发时间
            'exp' => time() + 3600,       // 过期时间（1小时）
            'data' => [
                'user_id' => $user->id,
                'username' => $user->username,
            ],
        ];

        $token = JWT::encode($payload, $key, 'HS256');

        // 返回登录成功响应
        return json([
            'code' => 200,
            'msg'  => '登录成功',
            'data' => [
                'token' => $token,
            ],
        ]);
    }
}