<h1 align="center"> thinkphp-oss </h1>

<p align="center"> Thinkphp Flysystem for the AliYun OSS storage..</p>


## Installing

```shell
$ composer require enoliu/thinkphp-oss -vvv
```

## config
添加oss配置到文件配置config/filesystem.php
```php
<?php

return [
    // 默认磁盘
    'default' => env('filesystem.driver', 'oss'),
    // 磁盘列表
    'disks'   => [
        'local'  => [
            'type' => 'local',
            'root' => app()->getRuntimePath() . 'storage',
        ],
        'public' => [
            // 磁盘类型
            'type'       => 'local',
            // 磁盘路径
            'root'       => app()->getRootPath() . 'public/storage',
            // 磁盘路径对应的外部URL路径
            'url'        => '/storage',
            // 可见性
            'visibility' => 'public',
        ],
        // 更多的磁盘配置信息
        'oss'    => [
            'type'         => 'oss',
            'accessId'     => 'LT******JwHf',
            'accessSecret' => 'MfSs*******cOzpP',
            'bucket'       => 'lo***e52',
            'endPoint'     => 'oss-cn-beijing.aliyuncs.com',
            // 'timeout'        => 3600,
            // 'connectTimeout' => 10,
            // 'isCName'        => false,
            // 'token'          => '',
            // 'useSSL'         => false    // 是否启用ssl
        ]
    ],
];

```

## Usage

```php
<?php
namespace app\controller;

use app\BaseController;
use think\facade\Filesystem;

class Upload extends BaseController
{
    public function demo()
    {
        $file = $this->request->file('file');

        $path1 = Filesystem::putFile('test/path', $file);
        $path2 = Filesystem::putFileAs('test/path', $file, $file->getOriginalName());
        $path3 = Filesystem::disk('oss')->putFile('test/path', $file);  // 指定disk驱动

        $url1 = Filesystem::getAdapter()->getUrl($path1);
        $url2 = Filesystem::getAdapter()->getUrl($path2);
        $url3 = Filesystem::disk('oss')->getAdapter()->getUrl($path3);

        return compact('path1','url1', 'path2', 'url2', 'path3', 'url3');
    }
}

```
## Response
```json
{
    "path1": "test/path/20210122/56737eece60bd855c78603848edcb10a.json",
    "url1": "http://lo***e52.oss-cn-beijing.aliyuncs.com/test/path/20210122/56737eece60bd855c78603848edcb10a.json",
    
    "path2": "test/path/item.json",
    "url2": "http://lo***e52.oss-cn-beijing.aliyuncs.com/test/path/item.json",
    
    "path3": "test/path/20210122/56737eece60bd855c78603848edcb10a.json",
    "url3": "http://lo***e52.oss-cn-beijing.aliyuncs.com/test/path/20210122/56737eece60bd855c78603848edcb10a.json"
}
```

## More
```php
use think\facade\Filesystem;

$config = [
    'dir'      => 'upload/tmp',
    'expire'   => 60 * 60,
    'callback' => 'http://www.baidu.com',
    'maxSize'  => 10 * 1024 * 1024
];
array Filesystem::getAdapter()->directUpload($config);
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/enoliu/thinkphp-oss/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/enoliu/thinkphp-oss/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT