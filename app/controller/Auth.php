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

        // 返回登录成功响应，包含 token 和用户完整信息
        return json([
            'code' => 200,
            'msg'  => '登录成功',
            'data' => [
                'token' => $token,
                'user' => $user->hidden(['password'])->toArray(), // 将用户模型转为数组，返回全部字段
            ],
        ]);
    }


    /**
     * 修改密码接口（需登录）
     *
     * @param Request $request
     * @return \think\Response
     */
    public function changePassword(Request $request)
    {
        // 获取请求参数
        $oldPassword = $request->post('old_password');
        $newPassword = $request->post('new_password');

        // 参数校验
        if (empty($oldPassword) || empty($newPassword)) {
            return json(['code' => 400, 'msg' => '旧密码和新密码不能为空']);
        }

        if (strlen($newPassword) < 6) {
            return json(['code' => 400, 'msg' => '新密码长度不能小于6位']);
        }

        // 获取当前登录用户 ID（来自 Token 或 Session，根据你的认证方式）
        $userId = $request->user['user_id'] ?? null;

        if (!$userId) {
            return json(['code' => 401, 'msg' => '未授权，请先登录']);
        }

        // 查询用户
        $user = User::find($userId);

        if (!$user) {
            return json(['code' => 404, 'msg' => '用户不存在']);
        }

        // 验证旧密码是否正确
        if (!password_verify($oldPassword, $user->password)) {
            return json(['code' => 401, 'msg' => '旧密码错误']);
        }

        // 加密新密码
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // 更新密码
        $user->password = $hashedPassword;

        if ($user->save()) {
            return json(['code' => 200, 'msg' => '密码修改成功']);
        } else {
            return json(['code' => 500, 'msg' => '密码修改失败，请稍后再试']);
        }
    }

    /**
     * 通过账号直接修改密码
     *
     * @param Request $request
     * @return \think\Response
     */
    public function resetPasswordByAccount(Request $request)
    {
        // 获取请求参数
        $username = $request->post('username');
        $newPassword = $request->post('new_password');

        // 参数校验
        if (empty($username) || empty($newPassword)) {
            return json(['code' => 400, 'msg' => '用户名和新密码不能为空']);
        }

        if (strlen($newPassword) < 6) {
            return json(['code' => 400, 'msg' => '新密码长度不能小于6位']);
        }

        // 查询用户
        $user = User::where('username', $username)->find();

        if (!$user) {
            return json(['code' => 404, 'msg' => '用户不存在']);
        }

        // 加密新密码
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // 更新密码
        $user->password = $hashedPassword;

        if ($user->save()) {
            return json(['code' => 200, 'msg' => '密码重置成功']);
        } else {
            return json(['code' => 500, 'msg' => '密码重置失败，请稍后再试']);
        }
    }

}