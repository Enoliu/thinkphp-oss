<?php


namespace Enoliu\Thinkphp\Oss;


use think\exception\InvalidArgumentException;
use think\helper\Str;

class Filesystem extends \think\Filesystem
{
    /**
     * 获取驱动类
     *
     * @param string $type
     *
     * @return string
     */
    protected function resolveClass(string $type): string
    {
        if ('oss' === $type) {
            $this->namespace = 'Enoliu\\Thinkphp\\Oss\\Driver\\';
        }

        if ($this->namespace || false !== strpos($type, '\\')) {
            $class = false !== strpos($type, '\\') ? $type : $this->namespace . Str::studly($type);

            if (class_exists($class)) {
                return $class;
            }
        }

        throw new InvalidArgumentException("Driver [$type] not supported.");
    }
}