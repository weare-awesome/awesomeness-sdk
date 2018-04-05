<?php

namespace WeAreAwesome\AwesomenessSDK;

use WeAreAwesome\AwesomenessSDK\Authentication\Authentication;
use WeAreAwesome\AwesomenessSDK\Http\ConnectionInterface;
use WeAreAwesome\AwesomenessSDK\Http\HttpRequests;

class Awesomeness
{

    /**
     * @var HttpRequests
     */
    protected $http;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var Authentication
     */
    protected $authentication;

    /**
     * Awesomeness constructor.
     *
     * @param HttpRequests $http
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct(
        HttpRequests $http,
        $clientId,
        $clientSecret
    ) {
        $this->connection = $http;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return HttpRequests
     */
    public function http()
    {
        return $this->http;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @return Authentication
     */
    public function getAuthentication()
    {
        return $this->authentication;
    }

    /**
     * @param Authentication $authentication
     */
    public function setAuthentication($authentication)
    {
        $this->authentication = $authentication;
    }

    /**
     * @return bool
     */
    public function isAuthenticated()
    {
        if(is_null($this->authentication)) {
            return false;
        }

        if($this->authentication->hasExpired()) {
            return true;
        }
        return false;
    }
}