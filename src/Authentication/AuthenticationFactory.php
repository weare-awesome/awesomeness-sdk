<?php

namespace WeAreAwesome\AwesomenessSDK\Authentication;

use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Token;

class AuthenticationFactory
{

    /**
     * @param $accessToken
     * @param $refreshToken
     *
     * @return Authentication
     */
    public static function make($accessToken, $refreshToken)
    {
        $token = self::parseAccessToken($accessToken);

        list($type, $id) = self::parseType($token);

        $authentication = self::getAuthenticationByType($type);
        $authentication->setAccessToken($accessToken);
        $authentication->setRefreshToken($refreshToken);
        $authentication->setExpires((new \DateTime())->setTimestamp($token->getClaim('exp')));
        $authentication->setScopes($token->getClaim('scopes'));

        if($authentication instanceof UserAuthenticationType) {
            $authentication->setUserId((int) $id);
        }
        return $authentication;
    }

    /**
     * @param $type
     *
     * @return Authentication
     */
    private static function getAuthenticationByType($type)
    {
        switch ($type)
        {
            case ('contact'):
                return new Contact();
            case ('user'):
                return new User();
            case ('client'):
                return new Client();
            default:
                return new Authentication();
        }
    }

    /**
     * @param Token $token
     *
     * @return array
     */
    private static function parseType(Token $token)
    {
        return explode(':', $token->getClaim('sub'));
    }

    /**
     * @param $accessToken
     *
     * @return Token
     */
    private static function parseAccessToken($accessToken)
    {
        $parser = new Parser();

        return $parser->parse($accessToken);
    }
}