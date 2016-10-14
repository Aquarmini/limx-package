打包工具
use limx\tools\Package;

$config = [
    // 项目根目录
    'root' => __DIR__,
    // 需要打包的相对文件夹
    'files' => [
        'vendor',
    ],
    // 复制后的文件地址
    // 样例地址 E:\phpStudy\WWW\zips\laravel
    // 压缩地址为 E:\phpStudy\WWW\zips\laravel.zip
    'dst' => 'E:\phpStudy\WWW\zips\package',
    // 版本号
    'vi' => '0.1',
];

$pro = new Package($config);
$pro->run();