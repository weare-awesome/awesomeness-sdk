<?php

namespace WeAreAwesome\AwesomenessSDK\Http;


use WeAreAwesome\AwesomenessSDK\Authentication\Authentication;

interface ConnectionInterface
{

    /**
     * @param Authentication $authentication | null
     */
    public function setAuthentication(Authentication $authentication = null);

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers = []);

    /**
     * @param $header
     * @param $value
     */
    public function addHeader($header, $value);

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

    /**
     * @param $uri
     * @param $fileContents
     *
     * @return mixed
     */
    public function sendFile($uri,  $fileContents);
}