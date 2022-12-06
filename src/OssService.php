<?php


namespace Enoliu\Thinkphp\Oss;


use think\Service;

class OssService extends Service
{
    public function register(): void
    {
        $this->app->bind('filesystem', Filesystem::class);
    }
}