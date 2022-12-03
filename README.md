## 安装
```
composer require liuyuanshan11/sd-micro-service-client
```
## 使用
```
use liuyuanshan11\SdMicroServiceClient\MicroService;

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
```