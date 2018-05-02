<?php

namespace WeAreAwesome\AwesomenessSDK\Http\Guzzle;

use GuzzleHttp\Client;
use function GuzzleHttp\Promise\unwrap;
use Psr\Http\Message\ResponseInterface;
use WeAreAwesome\AwesomenessSDK\Authentication\Authentication;
use WeAreAwesome\AwesomenessSDK\Http\ApiResponse;
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
     * @var Authentication
     */
    protected $authentication;

    /**
     * @var array
     */
    protected $headers;

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

    /**
     * @param AsyncRequest $asyncRequest
     *
     */
    public function addAsyncRequest(AsyncRequest $asyncRequest)
    {
        $this->requests[] = $asyncRequest;
    }

    /**
     * @param $uri
     * @param array $params
     * @param array $headers
     *
     * @return AsyncRequest
     */
    public function get($uri, array $params = [], array $headers = [])
    {
        $asyncRequest = AsyncRequest::make(
            'GET',
            $this->getUrl($uri),
            $params,
            array_merge($headers, $this->headers)
        );

        $this->addAsyncRequest($asyncRequest);

        return $asyncRequest;
    }

    /**
     * @param $uri
     *
     * @return string
     */
    private function getUrl($uri)
    {
        return trim($this->baseUrl, '/') . '/' . trim($uri, '/');
    }

    /**
     * @param $uri
     * @param array $params
     * @param array $headers
     *
     * @return AsyncRequest
     */
    public function post($uri, array $params = [], array $headers = [])
    {
        $asyncRequest = AsyncRequest::make(
            'POST',
            $this->getUrl($uri),
            $params,
            array_merge($headers, $this->headers)
        );

        $this->addAsyncRequest($asyncRequest);

        return $asyncRequest;
    }

    /**
     * @return void
     */
    public function call()
    {
        $promises = [];
        foreach ($this->requests as $request) {
            $promises[] = $this->client->requestAsync(
                $request->getMethod(),
                (
                strtolower($request->getMethod()) == 'get'
                    ? $request->getUrl() . '?' . http_build_query($request->getParams())
                    : $request->getUrl()
                ),
                [
                    'body' => json_encode($request->getParams()),
                    'headers' => $request->getHeaders()
                ]
            )->then(function (ResponseInterface $response) use ($request) {
                $request->setResponse(
                    ApiResponse::makeFromPsr7Response($response)
                );
            });
        }

        unwrap($promises);

    }

    /**
     * @param $authentication
     *
     */
    public function setAuthentication(Authentication $authentication = null)
    {
        $this->authentication = $authentication;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers = [])
    {
        $this->headers = $headers;
    }

    /**
     * @param $header
     * @param $value
     */
    public function addHeader($header, $value)
    {
        $this->headers[$header] = $value;
    }

}