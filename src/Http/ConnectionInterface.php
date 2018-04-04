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
     * @param array $headers
     *
     * @return mixed
     */
    public function get($uri, array $params = [], array $headers = []);

    /**
     * @param string $uri
     * @param array $params
     * @param array $headers
     *
     * @return mixed
     */
    public function post($uri, array $params = [], array $headers = []);

    /**
     * @return AsyncInterface
     */
    public function async();
}