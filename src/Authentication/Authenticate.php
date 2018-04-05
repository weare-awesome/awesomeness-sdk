<?php

namespace WeAreAwesome\AwesomenessSDK\Authentication;

use WeAreAwesome\AwesomenessSDK\Awesomeness;
use WeAreAwesome\AwesomenessSDK\Http\Cookies\Cookie;

class Authenticate
{
    const OAUTH_URL = '/users/oauth';

    const CONTACT_GRANT = 'contact_authentication';

    const USER_GRANT = 'user_authentication';


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

    /**
     * @param Cookie $cookie
     */
    public function fromCookie(Cookie $cookie)
    {
        $this->awesomeness->setAuthentication(
            AuthenticationFactory::make(
                $cookie->getAccessToken(),
                $cookie->getRefreshToken()
            )
        );
    }

    /**
     * @param $email
     * @param $password
     * @param bool $setCookie
     */
    public function asContact($email, $password, $setCookie = false)
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

        $this->awesomeness
            ->setAuthentication(
                AuthenticationFactory::make(
                    $apiResponse->getDataByKey('access_token'),
                    $apiResponse->getDataByKey('refresh_token')
                )
            );

        if($setCookie) {
            $this->setCookie();
        }
    }

    /**
     * @param $email
     * @param $password
     * @param bool $setCookie
     */
    public function asUser($email, $password, $setCookie = false)
    {
        $apiResponse =  $this->awesomeness
            ->http()
            ->sync()
            ->post(
                self::OAUTH_URL,
                [
                    'grant_type' => self::USER_GRANT,
                    'client_id' => $this->awesomeness->getClientId(),
                    'client_secret' => $this->awesomeness->getClientSecret(),
                    'username' => $email,
                    'password' => $password,
                    'scope' => 'user'
                ]
            );

        $this->awesomeness
            ->setAuthentication(
                AuthenticationFactory::make(
                    $apiResponse->getDataByKey('access_token'),
                    $apiResponse->getDataByKey('refresh_token')
                )
            );
        if($setCookie) {
            $this->setCookie();
        }
    }

    /**
     * @return void
     */
    private function setCookie()
    {
        $this->awesomeness->updateCookie();
    }

}