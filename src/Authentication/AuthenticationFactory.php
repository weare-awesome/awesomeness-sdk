<?php

namespace WeAreAwesome\AwesomenessSDK\Authentication;

use Lcobucci\JWT\Parser;

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

    }

    private function parseAccessToken($accessToken)
    {
        $parser = new Parser();

        return $parser->parse($accessToken);
    }
}