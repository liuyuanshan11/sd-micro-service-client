<?php

namespace SdMicroServiceClient;

use SdMicroServiceClient\constants\ResponseCode;
use function Couchbase\defaultDecoder;

class MicroServiceClient
{

    protected $service_url;
    protected $app_id;
    protected $app_secret;

    public function __constrct($serviceUrl, $appId, $appSecret)
    {
        var_dump(123);exit;
        $this->service_url = $serviceUrl;
        $this->app_id = $appId;
        $this->app_secret = $appSecret;
    }

    /**
     * @description 通过http的post请求node服务
     * @param role 必选 string controller
     * @param cmd 必选 string action
     * @param params 必选 string 参数
     * @return
     * @remark 备注信息
     */
    public function act()
    {
        if (!$this->isPost()) {
            $ret = [
                'code' => ResponseCode::ERROR_REQUEST_METHOD_ERROR['code'],
                'message' => 'The ' . $_SERVER['REQUEST_METHOD'] . ' method is not supported for this route. Supported methods: POST.',
                'data' => []
            ];
            echo json_encode($ret);
        }

        $data = file_get_contents('php://input');
        print_r(urldecode($data));
        exit;

        $url = '';
        $postData = [
            'appId' => '',
            'appSecret' => ''
        ];

        $headers = array(
            "Content-Type: application/json",
            "Accept: application/json"
        );

        $ret = $this->httpRequest($url, $headers, json_encode($postData));
        echo json_encode($ret);
    }

    /**
     * 判断是否为post
     * @return bool
     */
    protected function isPost()
    {
        return isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']) == 'POST';
    }

    /**
     * 判断是否为get
     * @return bool
     */
    protected function isGet()
    {
        return isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']) == 'GET';
    }

    /**
     * todo 将状态码统一配置文件管理
     * 请求数据
     * @param string $url 请求地址
     * @param array $postData 请求数据
     * @param array $headers 请求头  $headers[] = "application/x-www-form-urlencoded;charset=UTF8";
     * @param string $boom 在抓取整个网页响应内容时候需要关闭
     * @return array
     */
    public function httpRequest($url, $headers, $postData, $boom = true)
    {
        //初始化
        $curl = curl_init();
        //设置抓取的url;
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        //判断是否是https请求协议 0 表示请求是https，需要绕过
        if (0 === strpos(strtolower($url), 'https')) {
            //HTTPS请求需要加几行代码绕过SSL证书的检查等方式来成功请求到资源
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在 7.2 强制https 使用2
        }

        if (!empty($postData)) {
            curl_setopt($curl, CURLOPT_POST, true); //设置post方式提交
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData); //使用给出的关联（或下标）数组生成一个经过 URL-encode 的请求字符串。参数 formdata 可以是数组或包含属性的对象。
            //设置post数据
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//设置是否显示头信息
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        //执行命令
        $json = curl_exec($curl);
        $error = curl_error($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);//最后一个收到的HTTP代码
        $totalTime = curl_getinfo($curl, CURLINFO_TOTAL_TIME);//最后一次传输所消耗的时间

        //关闭URL请求
        curl_close($curl);
        if ($json === false) //请求失败
        {
            return ['code' => ResponseCode::ERROR_SERVER_UNAVAILABLE_ERROR['code'], 'message' => 'Curl request error reason: ' . $error, 'data' => []];
        }

        //是否开启去除boom头转json，开启如果则抓取网页内容则返回null
        $obj = $json;
        if ($boom) {
            if (preg_match('/^\xEF\xBB\xBF/', $json)) //去除boom 头
            {
                $output = substr($json, 3);
            } else {
                $output = $json;
            }
            $obj = json_decode(trim($output), true);
        }

        return ['code' => ResponseCode::NO_ERROR['code'], 'message' => ResponseCode::NO_ERROR['message'], 'data' => $obj];
    }
}