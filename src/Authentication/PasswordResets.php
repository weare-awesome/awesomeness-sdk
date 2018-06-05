<?php

namespace WeAreAwesome\AwesomenessSDK\Authentication;

use WeAreAwesome\AwesomenessSDK\Awesomeness;

class PasswordResets
{

    /**
     * @var Awesomeness
     */
    protected $awesomeness;

    /**
     * PasswordResets constructor.
     *
     * @param Awesomeness $awesomeness
     */
    public function __construct(Awesomeness $awesomeness)
    {
        $this->awesomeness = $awesomeness;
    }

    /**
     * @param $token
     * @param $password
     *
     * @return \WeAreAwesome\AwesomenessSDK\Http\ApiResponse
     */
    public function setPassword($token, $password)
    {
        $resposne = $this->awesomeness
            ->http()
            ->sync()
            ->post(
                '/contacts/auth/set-password',
                [
                    'password' => $password,
                    'token' => $token
                ]
            );

        return $resposne;
    }
}