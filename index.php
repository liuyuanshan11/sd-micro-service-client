<?php
use liuyuanshan11\SdMicroServiceClient\services\HttpMicroServiceClient;

include_once './vendor/autoload.php';

/*
 * $url = 192.168.102.11:11002/organizations/list
 * $serviceUrl = 192.168.102.11:11002
 * $controller = organizations
 * $action = list
 */
$obj  = new HttpMicroServiceClient('192.168.102.11:11002','appId', 'appSecret');
var_dump($obj->act('organizations','list',["key01"=>"value01","key02"=>"value02"]));