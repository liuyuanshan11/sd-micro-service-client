## 安装
```
composer require liuyuanshan11/sd-micro-service-client
```
## 使用
```
use liuyuanshan11\SdMicroServiceClient\MicroServiceClient;

    /*
     * $url = 192.168.102.11:11002/organizations/list
     * $serviceUrl = 192.168.102.11:11002
     * $controller = organizations
     * $action = list
     * $params = []
     */
public function index()
{
$obj = new MicroServiceClient('192.168.102.11:11002','appId', 'appSecret');
$obj->act('organizations','list',["key01"=>"value01"]);
}
```