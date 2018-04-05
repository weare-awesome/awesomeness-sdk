<?php

namespace WeAreAwesome\AwesomenessSDK\Authentication;

class AuthenticationException extends \Exception
{

    const SESSION_NOT_AUTHENTICATED_CODE = 1;

    /**
     * @var string|null
     */
    protected $loginPath;

    /**
     * AuthenticationException constructor.
     *
     * @param string $message
     * @param int $code
     * @param string | null $loginPath
     */
    public function __construct($message, $code, $loginPath = null)
    {
        $this->loginPath = $loginPath;
        parent::__construct(
            $message,
            $code
        );
    }

    /**
     * @return mixed
     */
    public function getLoginPath()
    {
        return $this->loginPath;
    }

    /**
     * @param null $loginPath
     *
     * @return static
     */
    public static function notAuthenticated($loginPath = null)
    {
        return new static(
            'Session not authenticated',
            self::SESSION_NOT_AUTHENTICATED_CODE,
            $loginPath
        );
    }
}