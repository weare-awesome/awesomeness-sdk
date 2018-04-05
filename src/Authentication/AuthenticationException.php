<?php

namespace WeAreAwesome\AwesomenessSDK\Authentication;

class AuthenticationException extends \Exception
{

    const SESSION_NOT_AUTHENTICATED_CODE = 1;

    /**
     * @return static
     */
    public static function notAuthenticated()
    {
        return new static('Session not authenticated', self::SESSION_NOT_AUTHENTICATED_CODE);
    }
}