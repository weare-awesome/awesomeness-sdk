<?php

namespace WeAreAwesome\AwesomenessSDK\Http;

interface ConnectionInterface
{


    /**
     * @param string $url
     */
    public function setBaseUrl($url);

    /**
     * @param string $uri
     * @param array $params
     *
     * @return ApiResponse
     */
    public function get($uri, array $params = []);

    /**
     * @param string $uri
     * @param array $params
     *
     * @return ApiResponse
     */
    public function post($uri, array $params = []);

    /**
     * @return AsyncInterface
     */
    public function async();
}