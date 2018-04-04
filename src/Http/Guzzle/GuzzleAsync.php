<?php


namespace WeAreAwesome\AwesomenessSDK\Http\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use WeAreAwesome\AwesomenessSDK\Http\AsyncInterface;
use WeAreAwesome\AwesomenessSDK\Http\AsyncRequest;

class GuzzleAsync implements AsyncInterface
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $requests = [];

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * GuzzleAsync constructor.
     *
     * @param Client $client
     * @param $baseUrl
     */
    public function __construct(Client $client, $baseUrl)
    {
        $this->client = $client;
        $this->baseUrl = $baseUrl;
    }

    public function addAsyncRequest(AsyncRequest $asyncRequest)
    {
        $this->requests[] = $asyncRequest;
    }

    public function get($uri, array $params = [], array $headers = [])
    {
        $asyncRequest = AsyncRequest::make(
            'GET',
                    $this->getUrl($uri),
                    $params,
                    $headers
        );

        $this->addAsyncRequest($asyncRequest);
        return $asyncRequest;
    }

    private function getUrl($uri)
    {
        return $this->baseUrl . '/' . trim($uri, '/');
    }

    public function post($uri, array $params = [], array $headers = [])
    {
        $asyncRequest = AsyncRequest::make(
            'POST',
            $this->getUrl($uri),
            $params,
            $headers
        );

        $this->addAsyncRequest($asyncRequest);
        return $asyncRequest;
    }

    public function call()
    {
        // TODO: Implement call() method.
    }

}