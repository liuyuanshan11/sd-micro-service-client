<?php

namespace SdMicroServiceClient\constants;
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

    // 系统code码
    const ERROR = ['code' => '10001', 'message' => 'fail'];
    const ERROR_SYSTEM = ['code' => '10002', 'message' => 'The request processing has failed due to some unknown error.'];
    const ERROR_INVALIDATOR = ['code' => '10003', 'message' => 'request validation failed'];
    const ERROR_INVALIDATE_TOKEN = ['code' => '10004', 'message' => 'User token invalidate'];
    const ERROR_INVALIDATE_ACCESS_TOKEN = ['code' => '10006', 'message' => 'Access token invalidate'];

    const AUTH_INVALID_SIGNATURE = ['code' => 'auth-20005', 'message' => 'Invalid Signature'];
    const AUTH_INVALID_API_KEY = ['code' => 'auth-20004', 'message' => 'Invalid Api Key'];
    const AUTH_INVALID_CREDENTIAL = ['code' => 'auth-20001', 'message' => 'username or password error'];
}