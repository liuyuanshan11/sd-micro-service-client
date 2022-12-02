<?php

namespace liuyuanshan11\SdMicroServiceClient\constants;
/**
 * 响应状态码定义类
 * Class ResponseCode.
 */
class ResponseCode
{
    // 常见code码
    const NO_ERROR = ['code' => '200', 'message' => 'Success'];
    const ERROR_BAD_REQUEST_ERROR = ['code' => '400', 'message' => 'Bad request'];
    const ERROR_UNAUTHORIZED_ERROR = ['code' => '401', 'message' => 'Unauthorized'];
    const ERROR_NOT_ALLOWED_ERROR = ['code' => '403', 'message' => 'Not allowed'];
    const ERROR_NOT_FOUND_ERROR = ['code' => '404', 'message' => 'Not found'];
    const ERROR_REQUEST_METHOD_ERROR = ['code' => '405', 'message' => 'Method not allowed'];
    const ERROR_SERVER_UNAVAILABLE_ERROR = ['code' => '500', 'message' => 'HTTP internal server error'];
}