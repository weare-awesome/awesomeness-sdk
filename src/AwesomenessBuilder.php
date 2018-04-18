<?php

namespace WeAreAwesome\AwesomenessSDK;

use GuzzleHttp\Client;
use WeAreAwesome\AwesomenessSDK\Exceptions\AwesomenessException;
use WeAreAwesome\AwesomenessSDK\Http\Guzzle\GuzzleAsync;
use WeAreAwesome\AwesomenessSDK\Http\Guzzle\GuzzleConnection;
use WeAreAwesome\AwesomenessSDK\Http\HttpRequests;

/**
 * Class AwesomenessBuilder
 * @package WeAreAwesome\AwesomenessSDK
 */
class AwesomenessBuilder
{

    /**
     * @var string
     */
    protected $baseUrl = 'https://api.builtonawesomeness.co.uk/api/v1';


    /**
     * @param $baseUrl
     *
     * @return $this
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @param $clientId
     * @param $clientSecret
     *
     * @return Awesomeness
     * @throws AwesomenessException
     */
    public function build($clientId, $clientSecret)
    {
        if(is_null($clientId) || is_null($clientSecret)) {
            throw AwesomenessException::failedToBuild();
        }

        $a = new Awesomeness(
            new HttpRequests(
                new GuzzleConnection(new Client(), $this->baseUrl),
                new GuzzleAsync(new Client(), $this->baseUrl)
            ),
            $clientId,
            $clientSecret
        );

        return $a;
    }

}