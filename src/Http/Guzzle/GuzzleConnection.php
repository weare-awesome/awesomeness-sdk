<?php

namespace WeAreAwesome\AwesomenessSDK\Http\Guzzle;

use GuzzleHttp\Client;
use WeAreAwesome\AwesomenessSDK\Http\AsyncInterface;
use WeAreAwesome\AwesomenessSDK\Http\ConnectionInterface;

class GuzzleConnection implements ConnectionInterface
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * GuzzleConnection constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function setBaseUrl($url)
    {
        // TODO: Implement setBaseUrl() method.
    }

    /**
     * @param $uri
     * @param $params
     * @param array $headers
     */
    public function get($uri, $params, array $headers = [])
    {
        // TODO: Implement get() method.
    }

    /**
     * @param $uri
     * @param $params
     * @param array $headers
     */
    public function post($uri, $params, array $headers = [])
    {
        // TODO: Implement post() method.
    }

    /**
     * @return GuzzleAsync
     */
    public function async()
    {
        // TODO: Implement async() method.
    }

}