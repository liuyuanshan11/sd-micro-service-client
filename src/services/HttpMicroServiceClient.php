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
        $url = $this->service_url . '/' . $controller . '/' . $action;

        $http_client = HttpClient::getInstance();
        $header = [
            'Content-Type' => 'application/json; charset=utf-8',
            'Authorization' => md5($this->app_id . $this->app_secret),
            'App-Id' => $this->app_id
        ];

        $http_client->post($url, $params, $header);

        //获取错误信息
        if ($http_client->getCode()) {
            return ['code' => ResponseCode::ERROR_SERVER_UNAVAILABLE_ERROR['code'], 'message' => 'Curl request error reason: ' . $http_client->getMessage(), 'data' => []];
        }

        //返回响应请求内容
        return $http_client->getBody();
    }

    /**
     * @var 清理垃圾
     */
    public function __destruct()
    {
        $this->service_url = null;
        $this->app_id = null;
        $this->app_secret = null;
    }
}