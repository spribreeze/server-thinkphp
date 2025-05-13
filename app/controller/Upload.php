<?php

namespace app\controller;

use think\Request;

class Upload
{
    /**
     * 上传图片接口
     *
     * @param Request $request
     * @return \think\Response
     */
    public function uploadImage(Request $request)
    {
        // 检查是否有文件上传
        if ($request->file('image')) {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $savename = \think\facade\Filesystem::disk('public')->putFile('uploads', $request->file('image'));
            if ($savename) {
                $webPath = str_replace('\\', '/', '/' . $savename);
                // 返回成功信息和文件路径
                return json([
                    'code' => 200,
                    'msg' => '上传成功',
                    'data' => [
                        'url' => '/storage' . $webPath , // 文件访问URL
                        'name' => $webPath ,
                        'fillUrl' => 'http://localhost:8000/storage' . $webPath ,

                    ],
                ]);
            } else {
                return json(['code' => 500, 'msg' => '上传失败']);
            }
        } else {
            return json(['code' => 400, 'msg' => '没有找到上传的文件']);
        }
    }
}