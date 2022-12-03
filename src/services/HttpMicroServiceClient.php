<?php

namespace liuyuanshan11\SdMicroServiceClient\services;

use liuyuanshan11\SdMicroServiceClient\constants\ResponseCode;
use liuyuanshan11\SdMicroServiceClient\http\HttpClient;

class HttpMicroServiceClient
{
    private $service_url;
    private $app_id;
    private $app_secret;

    public function __construct($serviceUrl, $appId, $appSecret)
    {
        $this->service_url = $serviceUrl;
        $this->app_id = $appId;
        $this->app_secret = $appSecret;
    }

    /**
     * @description 通过http的post请求node服务
     * @param controller string 控制器
     * @param action string 方法
     * @param params array 参数
     * @return array
     * @remark 备注信息
     */
    public function act(string $controller, string $action, array $params = [])
    {
        $headers = array(
            "Content-Type: application/json; charset=utf-8",
            "Accept: application/json",
            "Authorization: " . md5($this->app_id . $this->app_secret)
        );

        $url = $this->service_url . '/' . $controller . '/' . $action;

        $http_client = HttpClient::getInstance();
        $header = [
            'Content-Type' => 'application/json; charset=utf-8',
            'Authorization' => md5($this->app_id . $this->app_secret)
        ];

        $http_client->post('http://sdapi.test.top/c/test', $params, $header);

        //获取错误信息
        if ($http_client->getCode()) {
            return ['code' => ResponseCode::ERROR_SERVER_UNAVAILABLE_ERROR['code'], 'message' => 'Curl request error reason: ' . $http_client->getMessage(), 'data' => []];
        }

        //返回响应请求内容
        return $http_client->getBody();
    }
}