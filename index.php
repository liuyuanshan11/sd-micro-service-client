<?php

use liuyuanshan11\SdMicroServiceClient\MicroService;

include_once './vendor/autoload.php';


//最终实现：容器->对象（实例）->方法
//$obj->organizations->act();
$services = [
    'queue' => 'https://queue-service.sumian.com',
    'console' => 'https://console-service.sumian.com',
    'organization' => 'https://organization-service.sumian.com',
    'liu' => 'http://sdapi.test.top'
];

$obj = new MicroService('appId', 'appSecret', $services);
var_dump($obj->get('console')->act('controller', 'action', ["key01" => "value01"]));
var_dump($obj->get('queue')->act('c', 'getHeader', ["key01" => "value01"]));