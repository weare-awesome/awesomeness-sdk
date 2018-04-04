<?php

namespace WeAreAwesome\AwesomenessSDK\Http\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use WeAreAwesome\AwesomenessSDK\Http\AsyncInterface;
use WeAreAwesome\AwesomenessSDK\Http\ConnectionInterface;

class GuzzleConnection implements ConnectionInterface
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * GuzzleConnection constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $url
     */
    public function setBaseUrl($url)
    {
        $this->baseUrl = $url;
    }

    public function get($uri, array $params = [])
    {
        return $this->call(new Request(
            'GET',
            $this->getUrl($uri)
        ));
    }

    /**
     * @param string $uri
     *
     * @return string
     */
    private function getUrl($uri)
    {
        return trim($this->baseUrl, '/') . '/' . trim($uri, '/');
    }

    private function call(Request $request)
    {
        try {
            return $this->client->send($request);
        } catch (ServerException $e) {
            dd($e);
        }
    }

    public function post($uri, array $params = [])
    {

        return $this->call(new Request(
            'POST',
            $this->getUrl($uri),
            ['content-type' => 'application/json'],
            json_encode($params)
        ));
    }

    /**
     * @return GuzzleAsync
     */
    public function async()
    {
        // TODO: Implement async() method.
    }

}