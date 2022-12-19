## 安装
```
composer require liuyuanshan11/sd-micro-service-client
```
## 使用
```
use liuyuanshan11\SdMicroServiceClient\MicroService;

$services = [
    'member' => 'https://member-service-dev.sumian.com',
    'questionnaire' => 'https://questionnaire-service-dev.sumian.com',
    'organization' => 'https://organization-service-dev.sumian.com',
];
        
// 容器->服务（实例）->('模块', ‘方法’, '参数'): $micro->(service)->act(role, cmd, params)
$micro = new MicroService('appId', 'appSecret', $services);
$micro->get('member')->act('members', 'create', ["mobile" => "13200000000"]));
```
## CBTI微服务开放接口

[速眠微服务开放接口API](http://console-dev-apidoc.sumian.tech/apis/service-open-api)