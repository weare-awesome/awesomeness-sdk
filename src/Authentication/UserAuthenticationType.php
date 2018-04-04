<?php

namespace WeAreAwesome\AwesomenessSDK\Authentication;

interface UserAuthenticationType
{

    /**
     * @return int
     */
    public function getUserId();

    /**
     * @param int $userId
     */
    public function setUserId($userId);
}