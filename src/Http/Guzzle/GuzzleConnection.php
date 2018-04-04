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

    public function get($uri, array $params = [], array $headers = [])
    {
        // TODO: Implement get() method.
    }

    public function post($uri, array $params = [], array $headers = [])
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