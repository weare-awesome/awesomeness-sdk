<?php


namespace WeAreAwesome\AwesomenessSDK\Http;

interface AsyncInterface
{

    /**
     * @param AsyncRequest $asyncRequest
     *
     * @return mixed
     */
    public function addAsyncRequest(AsyncRequest $asyncRequest);

    /**
     * @param $uri
     * @param array $params
     *
     * @param array $headers
     *
     * @return mixed
     */
    public function get($uri, array $params = [], array $headers = []);

    /**
     * @param $uri
     * @param array $params
     *
     * @param array $headers
     *
     * @return mixed
     */
    public function post($uri, array $params = [], array $headers = []);

    /**
     * @return void
     */
    public function call();

}