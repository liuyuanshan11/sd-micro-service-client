<?php
use SdMicroServiceClient\MicroServiceClient;

include_once './vendor/autoload.php';

$obj  = new MicroServiceClient('http://sdapi.demo.com/admin/liu',2,3);
var_dump($obj->act());