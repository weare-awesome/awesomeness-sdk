<?php

namespace WeAreAwesome\AwesomenessSDK\Endpoints;

use WeAreAwesome\AwesomenessSDK\Awesomeness;

interface EndpointInterface
{
    public function __construct(Awesomeness $awesomeness);
}