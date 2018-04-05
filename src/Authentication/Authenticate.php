<?php

namespace WeAreAwesome\AwesomenessSDK\Authentication;

use WeAreAwesome\AwesomenessSDK\Awesomeness;

class Authenticate
{
    const OAUTH_URL = '/users/oauth';

    const CONTACT_GRANT = 'contact_authentication';
    /**
     * @var Awesomeness
     */
    protected $awesomeness;

    /**
     * Authenticate constructor.
     *
     * @param Awesomeness $awesomeness
     */
    public function __construct(Awesomeness $awesomeness)
    {
        $this->awesomeness = $awesomeness;
    }


    public function asContact($email, $password)
    {
        $apiResponse =  $this->awesomeness
            ->http()
            ->sync()
            ->post(
                self::OAUTH_URL,
                [
                    'grant_type' => self::CONTACT_GRANT,
                    'client_id' => $this->awesomeness->getClientId(),
                    'client_secret' => $this->awesomeness->getClientSecret(),
                    'username' => $email,
                    'password' => $password,
                    'scope' => 'contact'
                ]
            );
    }

}