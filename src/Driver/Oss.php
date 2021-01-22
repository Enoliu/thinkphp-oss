<?php


namespace Enoliu\Thinkphp\Oss\Driver;


use Enoliu\Flysystem\Oss\OssAdapter;
use League\Flysystem\AdapterInterface;
use think\filesystem\Driver;

class Oss extends Driver
{
    protected function createAdapter(): AdapterInterface
    {
        return new OssAdapter($this->config);
    }
}