<?php
// +----------------------------------------------------------------------
// | Demo [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2016/10/14 Time: 14:51
// +----------------------------------------------------------------------
namespace limx\tools;
class Package
{
    private $config = [
        // 项目根目录
        'root' => '',
        // 需要打包的相对文件夹
        'files' => [
            'app',
            'resources',
            'database',
            'config/app.php',
        ],
        // 复制后的文件地址
        // 样例地址 E:\phpStudy\WWW\zips\laravel
        // 压缩地址为 E:\phpStudy\WWW\zips\laravel.zip
        'dst' => 'E:\phpStudy\WWW\zips\package',
        // 版本号
        'vi' => '',
    ];

    public function __construct($config = [])
    {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * [run desc]
     * @desc 打包程序
     * @author limx
     */
    public function run()
    {
        if ($this->isConfig()) {
            $app = $this->config;
            $res = \limx\func\File::copy($app['root'], $app['files'], $app['dst']);
            if ($res === false) {
                $this->error('the files copy failed');
                return false;
            }
            $vi = empty($app['vi']) ? 'master' : $app['vi'];
            $zipname = basename($app['dst']) . '_vi.' . $vi . '.' . time() . '.zip';
            $res = \limx\func\File::zip(dirname($app['dst']), basename($app['dst']), dirname($app['dst']), $zipname);
            if ($res === true) {
                $this->info('package the program success');
            } else {
                $this->error('zip files failed:code=' . $res);
            }
        }
    }

    /**
     * [isConfig desc]
     * @desc 查看配置是否正确
     * @author limx
     */
    private function isConfig()
    {
        if (empty($this->config['root']) || empty($this->config['files']) || empty($this->config['dst'])
            || empty($this->config['vi'])
        ) {
            $this->error('the config is error!');
            return false;
        }
        return true;
    }

    private function info($msg)
    {
        echo "{$msg}\n";
    }

    private function error($msg)
    {
        echo "ERROR:{$msg}\n";
    }
}