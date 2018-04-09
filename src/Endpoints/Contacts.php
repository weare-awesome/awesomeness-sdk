<?php

namespace WeAreAwesome\AwesomenessSDK\Endpoints;

use WeAreAwesome\AwesomenessSDK\Awesomeness;

class Contacts
{

    /**
     * @var Awesomeness $awesomeness
     */
    protected $awesomeness;

    /**
     * Contacts constructor.
     *
     * @param Awesomeness $awesomeness
     */
    public function __construct(Awesomeness $awesomeness)
    {
        $this->awesomeness = $awesomeness;
    }

    public function me()
    {
        return $this->
        awesomeness
            ->http()
            ->sync()
            ->get('contacts/me', [], $this->awesomeness->authentication());
    }

    public function byId($id)
    {
        return $this->awesomeness
            ->http()
            ->sync()
            ->get("contacts/$id");
    }
}