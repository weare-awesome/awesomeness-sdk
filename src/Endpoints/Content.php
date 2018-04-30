<?php


namespace WeAreAwesome\AwesomenessSDK\Endpoints;

use WeAreAwesome\AwesomenessSDK\Awesomeness;

class Content implements EndpointInterface
{

    /**
     * @var Awesomeness
     */
    protected $awesomeness;

    public function __construct(Awesomeness $awesomeness)
    {
        $this->awesomeness = $awesomeness;
    }


    public function getPageBySlug($slug, array $additionalContent = [])
    {

    }

}