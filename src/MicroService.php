<?php

namespace liuyuanshan11\SdMicroServiceClient;

use liuyuanshan11\SdMicroServiceClient\services\HttpMicroServiceClient;

class MicroService
{
    //定义容器
    private static $objects;

    private $app_id;
    private $app_secret;
    private $services;

    protected $bind = [
        'liu',
        'queue',
        'console',
        'organization',
        'common',
        'dict',
        'log',
        'member',
        'material',
        'websocket',
        'questionnaire'
    ];

    public function __construct(string $appId, string $appSecret, array $services)
    {
        $this->app_id = $appId;
        $this->app_secret = $appSecret;
        $this->services = $this->filterServices($services);
        $this->init();
    }

    public function init()
    {
        foreach ($this->services as $key => $value) {
            self::set($key, new HttpMicroServiceClient($value, $this->app_id, $this->app_secret));
        }
    }

    //过滤不存在的服务
    private function filterServices($services)
    {
        $arr = [];
        foreach ($this->bind as $val) {
            if ($services[$val]) {
                $arr[$val] = $services[$val];
            }
        }
        return $arr;
    }

    //注册对象进入容器
    public static function set($key, $obj)
    {
        //已经创建好的对象，挂载到某个全局可以使用的数组上，在需要使用的时候，直接从该诉数组上获取即可
        if (isset(static::$objects[$key])) {
            throw new \Exception('该类已注册');
        }
        static::$objects[$key] = $obj;
        return true;
    }


    //从容器中获取指定对象
    public static function get($key)
    {
        if (!isset(static::$objects[$key])) {
            throw new \Exception('该类未注册');
        }
        return static::$objects[$key];
    }

    //获取容器中的所有对象
    public static function all()
    {
        return static::$objects;
    }
}