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

    /**
     * @return \WeAreAwesome\AwesomenessSDK\Http\ApiResponse
     */
    public function me()
    {
        return $this->
        awesomeness
            ->http()
            ->sync()
            ->get('contacts/me',
                [],
                $this->awesomeness
                    ->authentication()
            );
    }

    /**
     * @param array $params
     *
     * @return \WeAreAwesome\AwesomenessSDK\Http\ApiResponse
     */
    public function updateMe(array $params = [])
    {
        return $this->awesomeness
            ->http()
            ->sync()
            ->post(
                'contacts/me',
                $params,
                $this->awesomeness
                    ->authentication()
            );
    }

    /**
     * @param $id
     *
     * @return \WeAreAwesome\AwesomenessSDK\Http\ApiResponse
     */
    public function byId($id)
    {
        return $this->awesomeness
            ->http()
            ->sync()
            ->get("contacts/$id");
    }
}