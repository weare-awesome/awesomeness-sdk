<?php

namespace WeAreAwesome\AwesomenessSDK;

use WeAreAwesome\AwesomenessSDK\Authentication\Authenticate;
use WeAreAwesome\AwesomenessSDK\Authentication\Authentication;
use WeAreAwesome\AwesomenessSDK\Authentication\AuthenticationException;
use WeAreAwesome\AwesomenessSDK\Authentication\Client;
use WeAreAwesome\AwesomenessSDK\Endpoints\Contacts;
use WeAreAwesome\AwesomenessSDK\Endpoints\Content;
use WeAreAwesome\AwesomenessSDK\Endpoints\Media;
use WeAreAwesome\AwesomenessSDK\Endpoints\Messages;
use WeAreAwesome\AwesomenessSDK\Http\Cookies\Cookie;
use WeAreAwesome\AwesomenessSDK\Http\HttpRequests;

class Awesomeness
{

    /**
     * @var int
     */
    protected $accountId;

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
     * @var Client
     */
    protected $clientAuthentication;

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
     * @return Client
     */
    public function getClientAuthentication()
    {
        return $this->clientAuthentication;
    }

    /**
     * @param Client $clientAuthentication
     */
    public function setClientAuthentication(Client $clientAuthentication)
    {
        $this->clientAuthentication = $clientAuthentication;
    }

    /**
     * @param integer $id
     */
    public function setAccountId($id)
    {
        $this->accountId = $id;
        $this->http->addHeader(
            HttpRequests::ACCOUNT_HEADER,
            $id
        );
    }

    public function getAccountId()
    {
        return $this->accountId;
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
    public function setAuthentication(Authentication $authentication = null)
    {
        $this->authentication = $authentication;
        $this->http->setAuthentication($authentication);
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
    public function removeCookie()
    {
        Cookie::expireCookie();
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

    /**
     * @return Contacts
     */
    public function contacts()
    {
        return new Contacts($this);
    }

    /**
     * @return Messages
     */
    public function messages()
    {
        return new Messages($this);
    }

    /**
     * @return Content
     */
    public function content()
    {
        return new Content($this);
    }

    /**
     * @return Media
     */
    public function media()
    {
        return new Media($this);
    }

    public function requireClientAuthentication()
    {
        if(!$this->getClientAuthentication()) {
            throw new AuthenticationException('You must be authenticated as a client', 401);
        }

        return true;
    }
}