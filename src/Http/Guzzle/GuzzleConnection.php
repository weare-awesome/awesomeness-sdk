<?php

namespace WeAreAwesome\AwesomenessSDK\Http\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use WeAreAwesome\AwesomenessSDK\Authentication\Authentication;
use WeAreAwesome\AwesomenessSDK\Authentication\AuthenticationException;
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

    /**
     * @param string $uri
     * @param array $params
     * @param Authentication|null $authentication
     *
     * @return null|ApiResponse
     */
    public function get(
        $uri,
        array $params = [],
        Authentication $authentication = null
    ) {
        return $this->call(new Request(
            'GET',
            $this->getUrl($uri)
        ),
            $authentication
        );
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

    /**
     * @param ApiResponse $apiResponse
     * @param Response $response
     *
     * @return ApiResponse
     */
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

    /**
     * @param Request $request
     *
     * @param Authentication|null $authentication
     *
     * @return null|ApiResponse
     * @throws AuthenticationException
     */
    private function call(Request $request, Authentication $authentication = null)
    {
        if ($authentication) {
            $request = $request->withAddedHeader(
                'Authorization',
                'Bearer ' . $authentication->getAccessToken()
            );
        }

        try {
            $response = $this->client->send($request);

            if (!$response instanceof Response) {
                return null;
            }

            return $this->hydrateApiResponse(new ApiResponse(), $response);

        } catch (ServerException $e) {
            dd($e);
        } catch (ClientException $e) {

            if($e->getResponse()->getStatusCode() == 401) {
                throw AuthenticationException::notAuthenticated();
            }

            return $this->hydrateApiResponse(new ApiResponse(), $e->getResponse());
        }
    }

    /**
     * @param string $uri
     * @param array $params
     * @param Authentication|null $authentication
     *
     * @return null|ApiResponse
     */
    public function post(
        $uri,
        array $params = [],
        Authentication $authentication = null
    ) {

        return $this->call(new Request(
            'POST',
            $this->getUrl($uri),
            ['content-type' => 'application/json'],
            json_encode($params)
        ),
            $authentication
        );
    }

    /**
     * @return GuzzleAsync
     */
    public function async()
    {
        // TODO: Implement async() method.
    }

}