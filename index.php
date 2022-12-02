<?php
use liuyuanshan11\SdMicroServiceClient\MicroServiceClient;

include_once './vendor/autoload.php';

/*
 * $url = 192.168.102.11:11002/organizations/list
 * $serviceUrl = 192.168.102.11:11002
 * $controller = organizations
 * $action = list
 */
$obj  = new MicroServiceClient('192.168.102.11:11002',2,3);
var_dump($obj->act('organizations','list',["key01"=>"value01"]));