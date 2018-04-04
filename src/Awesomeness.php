<?php

namespace WeAreAwesome\AwesomenessSDK;

use WeAreAwesome\AwesomenessSDK\Authentication\Authentication;
use WeAreAwesome\AwesomenessSDK\Http\ConnectionInterface;

class Awesomeness
{

    /**
     * @var ConnectionInterface
     */
    protected $connection;

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
     * @param ConnectionInterface $connection
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct(
        ConnectionInterface $connection,
        $clientId,
        $clientSecret
    ) {
        $this->connection = $connection;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return ConnectionInterface
     */
    public function getConnection()
    {
        return $this->connection;
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

        return true;
    }
}