<?php

namespace liuyuanshan11\SdMicroServiceClient\http;

/**
 * @var HttpClient
 */
class HttpClient
{
    /**
     * @var 请求的路径
     */
    private $url;

    /**
     * @var 请求方式
     */
    private $method;

    /**
     * @var 请求参数
     */
    private $param;

    /**
     * @var 请求头
     */
    private $header;

    /**
     * @var 响应结果
     */
    private $response;

    //1.创建一个静态私有变量存放实例化的对象
    private static $instance;

    //2.创建一个私有构造函数
    private function __construct()
    {
    }

    //3.防止外部克隆该类
    private function __clone()
    {
    }

    //4.防止序列化
    private function __wakeup()
    {
    }

    //5.提供唯一的静态入口
    public static function getInstance()
    {
        //判断$instance变量是否是HttpClient类的实例，如果不是，则实例化本身，如果是则直接返回
        //instanceof 用于确定一个 PHP 变量是否属于某一类 class 的实例
        if (!(static::$instance instanceof static)) { //static 换成self也可以，只不过static比self更精准些
            static::$instance = new static;
        }
        return static::$instance;
    }


    /**
     * @param string url
     *
     * @return HttpClient
     * @var 设置请求路径
     *
     */
    private function setUrl(string $url = '')
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param array param
     *
     * @return HttpClient
     * @var 设置请求参数
     *
     */
    private function setParam(array $param)
    {
        switch ($this->method) {
            case 'GET':
                $this->param = http_build_query($param);
                break;
            case 'POST':
                $this->param = json_encode($param, JSON_UNESCAPED_UNICODE);
                break;
            default:
                $this->param = $param;
        }

        return $this;
    }

    /**
     * @param array header
     *
     * @return HttpClient
     * @var 设置请求头部
     *
     */
    private function setHeader(array $header)
    {
        foreach ($header as $key => $value) {
            $this->header[] = $key . ': ' . $value;
        }

        return $this;
    }

    /**
     * @param string method
     *
     * @return HttpClient
     * @var 设置请求方式
     *
     */
    private function setMethod(string $method = 'GET')
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return HttpClient
     * @var 开始请求
     *
     */
    private function exec()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_URL, $this->url);

        if ($this->method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->param);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
//            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                'Content-Type: application/json; charset=utf-8',
//                'Content-Length: ' . strlen($this->param)
//            ));
        } elseif ($this->method == 'GET') {
            curl_setopt($ch, CURLOPT_URL, $this->url . '?' . $this->param);
            curl_setopt($ch, CURLOPT_HEADER, false);
        }

        $info = curl_getinfo($ch);
        $data = curl_exec($ch);
        $error = curl_errno($ch);
        curl_close($ch);

        $this->response = [
            'code' => $error ? 1 : 0,
            'message' => $error,
            'info' => $info,
            'data' => $data,
        ];
        return $this;
    }

    /**
     * @return array|string
     * @var 获取响应数据
     *
     * @throw Exception
     *
     */
    public function getBody()
    {
        if (!$this->response) {
            throw new Exception('no httpRequest');
        }

        return $this->response['data'];
    }

    /**
     * @return int
     * @var 获取响应状态码
     *
     * @throw Exception
     *
     */
    public function getCode()
    {
        if (!$this->response) {
            throw new Exception('no httpRequest');
        }

        return $this->response['code'];
    }

    /**
     * @return int|array
     * @var 获取错误信息
     *
     * @throw Exception
     *
     */
    public function getMessage()
    {
        if (!$this->response) {
            throw new \Exception('no httpRequest');
        }

        return $this->response['message'];
    }

    /**
     * @return array
     * @var 获取响应信息
     *
     */
    public function getInfo()
    {
        if (!$this->response) {
            throw new Exception('no httpRequest');
        }

        return $this->response['info'];
    }

    /**
     * @param string url
     * @param array param
     * @param array header
     *
     * @return HttpClient
     * @var GET请求
     *
     */
    public function get(string $url, array $param = [], array $header = [])
    {
        return $this->setMethod('GET')->setUrl($url)->setParam($param)->setHeader($header)->exec();
    }

    /**
     * @param string url
     * @param array param
     * @param array header
     *
     * @return HttpClient
     * @var POST请求
     *
     */
    public function post(string $url, array $param = [], $header = [])
    {
        return $this->setMethod('POST')->setUrl($url)->setParam($param)->setHeader($header)->exec();
    }

    /**
     * @var 清理垃圾
     */
    public function __destruct()
    {
        $this->url = null;
        $this->method = null;
        $this->param = null;
        $this->header = null;
        $this->response = null;
    }
}
