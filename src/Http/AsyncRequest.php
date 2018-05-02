<?php

namespace WeAreAwesome\AwesomenessSDK\Http;

use GuzzleHttp\Psr7\Response;

class AsyncRequest
{

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var ApiResponse
     */
    protected $response;

    /**
     * @var array
     */
    protected $params;

    /**
     * @var array
     */
    protected $headers;


    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return ApiResponse
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param ApiResponse $response
     */
    public function setResponse(ApiResponse $response)
    {
        $this->response = $response;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }


    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * @param $method
     * @param $url
     * @param array $params
     * @param array $headers
     *
     * @return AsyncRequest
     */
    public static function make($method, $url, array $params = [], array $headers = [])
    {
        $ar = new static();
        $ar->setUrl($url);
        $ar->setMethod($method);
        $ar->setParams($params);
        $ar->setHeaders($headers);
        return $ar;
    }
}