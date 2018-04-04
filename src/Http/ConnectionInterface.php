<?php

namespace WeAreAwesome\AwesomenessSDK\Http;

interface ConnectionInterface
{


    /**
     * @param $url
     */
    public function setBaseUrl($url);

    /**
     * @param $uri
     * @param $params
     * @param array $headers
     *
     * @return mixed
     */
    public function get($uri, $params, array $headers = []);

    /**
     * @param $uri
     * @param $params
     * @param array $headers
     *
     * @return mixed
     */
    public function post($uri, $params, array $headers = []);

    /**
     * @return AsyncInterface
     */
    public function async();
}