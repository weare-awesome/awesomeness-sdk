<?php


namespace WeAreAwesome\AwesomenessSDK\Http\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Promise;
use function GuzzleHttp\Promise\unwrap;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use WeAreAwesome\AwesomenessSDK\Authentication\Authentication;
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
        return trim($this->baseUrl, '/') . '/' . trim($uri, '/');
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
        $promises = [];
        foreach ($this->requests as $request) {
            $promises[] = $this->client->requestAsync(
                $request->getMethod(),
                $request->getUrl()
            )->then(function(ResponseInterface $response) use($request) {
                $request->setResponse($response);
            });
        }

        $results = unwrap($promises);


    }

    /**
     * @param $authentication
     *
     */
    public function setAuthentication(Authentication $authentication = null)
    {
        $this->authentication = $authentication;
    }
}