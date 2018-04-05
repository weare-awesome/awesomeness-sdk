<?php

namespace WeAreAwesome\AwesomenessSDK\Http\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use WeAreAwesome\AwesomenessSDK\Http\ApiResponse;
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
     * @param $baseUrl
     */
    public function __construct(Client $client, $baseUrl)
    {
        $this->client = $client;
        $this->baseUrl = $baseUrl;
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

    private function hydrateApiResponse(ApiResponse $apiResponse, Response $response)
    {
        $body = json_decode($response->getBody(), true);

        $apiResponse->setMessage($body['message']);
        $apiResponse->setCode($body['code']);
        $apiResponse->setData($body['data']);
        $apiResponse->setErrors($body['errors']);
        $apiResponse->setDescription($body['description']);

        return $apiResponse;
    }

    private function call(Request $request)
    {
        try {
            $response = $this->client->send($request);

            if(!$response instanceof Response) {
                return null;
            }

            return $this->hydrateApiResponse(new ApiResponse(), $response);

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