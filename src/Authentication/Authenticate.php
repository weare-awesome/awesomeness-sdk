<?php

namespace WeAreAwesome\AwesomenessSDK\Authentication;

use WeAreAwesome\AwesomenessSDK\Awesomeness;
use WeAreAwesome\AwesomenessSDK\Http\Cookies\Cookie;

class Authenticate
{
    const OAUTH_URL = '/oauth';

    const CONTACT_GRANT = 'contact_authentication';

    const USER_GRANT = 'user_authentication';

    const CLIENT_GRANT = 'client_credentials';

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

    public function client()
    {
        $apiResponse = $this->awesomeness
            ->http()
            ->sync()
            ->post(
                self::OAUTH_URL,
                [
                    'grant_type' => self::CLIENT_GRANT,
                    'client_id' => $this->awesomeness->getClientId(),
                    'client_secret' => $this->awesomeness->getClientSecret()
                ]
            );

        if ($apiResponse->getCode() !== 200) {
            $this->throwException($apiResponse->getCode());
        }

        $this->awesomeness
            ->setClientAuthentication(
                AuthenticationFactory::make(
                    $apiResponse->getDataByKey('access_token')
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
        $apiResponse = $this->awesomeness
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

        if ($apiResponse->getCode() !== 200) {
            $this->throwException($apiResponse->getCode());
        }

        $this->awesomeness
            ->setAuthentication(
                AuthenticationFactory::make(
                    $apiResponse->getDataByKey('access_token'),
                    $apiResponse->getDataByKey('refresh_token')
                )
            );

        if ($setCookie) {
            $this->setCookie();
        }
    }

    private function throwException($code)
    {
        switch ($code) {
            case 401 : {
                throw AuthenticationException::invalidCredentials();
            }
            default: {
                throw new \Exception();
            }
        }
    }

    /**
     * @param $email
     * @param $password
     * @param bool $setCookie
     */
    public function asUser($email, $password, $setCookie = false)
    {
        $apiResponse = $this->awesomeness
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

        if ($apiResponse->getCode() !== 200) {
            $this->throwException($apiResponse->getCode());
        }

        $this->awesomeness
            ->setAuthentication(
                AuthenticationFactory::make(
                    $apiResponse->getDataByKey('access_token'),
                    $apiResponse->getDataByKey('refresh_token')
                )
            );
        if ($setCookie) {
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

    /**
     * @return void
     */
    public function logout()
    {
        $this->awesomeness->removeCookie();
        $this->awesomeness->setAuthentication(null);
    }

}