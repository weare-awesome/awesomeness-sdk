<?php

namespace WeAreAwesome\AwesomenessSDK\Exceptions;

class AwesomenessException extends \Exception
{
    public static function failedToBuild()
    {
        return new static('Failed to build. Make sure you have passed correct details');
    }
}