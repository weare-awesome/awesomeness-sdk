<?php


namespace WeAreAwesome\AwesomenessSDK\Authentication;

class Contact extends Authentication implements UserAuthenticationType
{

    /**
     * @var int
     */
    protected $userId;

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

}