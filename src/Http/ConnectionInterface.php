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
     * @return mixed
     */
    public function get($uri, array $params = []);

    /**
     * @param string $uri
     * @param array $params
     *
     * @return mixed
     */
    public function post($uri, array $params = []);

    /**
     * @return AsyncInterface
     */
    public function async();
}