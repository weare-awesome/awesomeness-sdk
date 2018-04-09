<?php

namespace WeAreAwesome\AwesomenessSDK\Http;


use WeAreAwesome\AwesomenessSDK\Authentication\Authentication;

interface ConnectionInterface
{

    /**
     * @param string $uri
     * @param array $params
     *
     * @param Authentication|null $authentication
     *
     * @return ApiResponse
     */
    public function get($uri, array $params = [], Authentication $authentication = null);

    /**
     * @param string $uri
     * @param array $params
     *
     * @param Authentication|null $authentication
     *
     * @return ApiResponse
     */
    public function post($uri, array $params = [], Authentication $authentication = null);

}