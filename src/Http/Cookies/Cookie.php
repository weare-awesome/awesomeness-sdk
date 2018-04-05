<?php

namespace WeAreAwesome\AwesomenessSDK\Http\Cookies;

use WeAreAwesome\AwesomenessSDK\Awesomeness;

class Cookie
{

    const COOKIE_NAME = 'awesomeness';

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var string
     */
    protected $refreshToken;

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    public function toArray()
    {
        return [
            'access_token' => $this->getAccessToken(),
            'refresh_token' => $this->getRefreshToken()
        ];
    }

    public function __toString()
    {
        return base64_encode(json_encode($this->toArray()));
    }

    /**
     * @return null|Cookie
     */
    public static function getCookie()
    {
        if (isset($_COOKIE[self::COOKIE_NAME])) {
            $array = self::decodeCookieString($_COOKIE[self::COOKIE_NAME]);
            $cookie = new self();
            $cookie->setAccessToken($array['access_token']);
            $cookie->setRefreshToken($array['refresh_token']);

            return $cookie;
        }

        return null;
    }

    /**
     * @param Awesomeness $awesomeness
     *
     * @return Cookie
     */
    public static function make(Awesomeness $awesomeness)
    {
        $cookie = new self();

        if ($authentication = $awesomeness->authentication()) {
            $cookie->setAccessToken($authentication->getAccessToken());
            $cookie->setRefreshToken($authentication->getRefreshToken());
        }

        return $cookie;
    }

    /**
     * @param Cookie $cookie
     *
     * @param int $expires
     *
     * @return bool
     */
    public static function setCookie(Cookie $cookie, $expires)
    {
        return setcookie(
            self::COOKIE_NAME,
            $cookie,
            $expires,
            '/'
        );
    }

    /**
     * @param $cookie
     *
     * @return array
     */
    public static function decodeCookieString($cookie)
    {
        return json_decode(base64_decode($cookie), true);
    }

    /**
     * @return bool
     */
    public static function expireCookie()
    {
        return setcookie(
            self::COOKIE_NAME,
            null,
            (time() - 3600)
        );
    }
}
