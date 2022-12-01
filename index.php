<?php
use SdMicroServiceClient\MicroServiceClient;

include_once './vendor/autoload.php';

$obj  = (new MicroServiceClient());
var_dump($obj->act());