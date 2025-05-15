<?php

namespace app\middleware;

use think\Response;
use think\facade\Env;

class ReplaceLocalhost
{
    public function handle($request, \Closure $next)
    {

        // 从.env文件获取配置
        $shouldReplace = Env::get('LOCALHOST_REPLACE', false); // 默认为false

        /** @var Response $response */
        $response = $next($request);

        // 只处理 JSON 响应类型
        if ($shouldReplace && $response->getHeader('Content-Type') && strpos($response->getHeader('Content-Type'), 'application/json') !== false) {
            $content = $response->getContent();

            // 替换 localhost 为指定 IP
            $newContent = str_replace('localhost:8000', '139.224.250.70:8000', $content);

            // 设置新的响应内容
            $response->content($newContent);
        }

        return $response;
    }
}