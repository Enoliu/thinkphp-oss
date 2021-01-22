<?php


namespace Enoliu\Thinkphp\Oss;


use think\Service;

class OssService extends Service
{
    public function register(): void
    {
        $res = $this->app->bind('filesystem', Filesystem::class);
    }
}