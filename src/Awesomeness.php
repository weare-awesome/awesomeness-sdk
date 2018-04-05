<?php

namespace WeAreAwesome\AwesomenessSDK;

use WeAreAwesome\AwesomenessSDK\Authentication\Authenticate;
use WeAreAwesome\AwesomenessSDK\Authentication\Authentication;
use WeAreAwesome\AwesomenessSDK\Http\Cookies\Cookie;
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
        $this->http = $http;
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
    public function authentication()
    {
        return $this->authentication;
    }

    /**
     * @return Authenticate
     */
    public function authenticate()
    {
        return new Authenticate($this);
    }

    /**
     * @param Authentication $authentication
     */
    public function setAuthentication(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    /**
     * @return void
     */
    public function setSessionFromCookie()
    {
        $cookie = Cookie::getCookie();

        if (!is_null($cookie)) {
            $this->authenticate()->fromCookie($cookie);
        }
    }

    /**
     * @return void
     */
    public function updateCookie()
    {
        $cookie = Cookie::make($this);
        Cookie::setCookie(
            $cookie,
            $this->authentication()
                ->getExpires()
                ->getTimestamp()
        );
    }

    /**
     * @return bool
     */
    public function isAuthenticated()
    {
        if (is_null($this->authentication)) {
            return false;
        }

        if (!$this->authentication->hasExpired()) {
            return true;
        }

        return false;
    }
}