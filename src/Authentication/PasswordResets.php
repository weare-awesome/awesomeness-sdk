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

    public function setPassword($token, $password)
    {

    }
}