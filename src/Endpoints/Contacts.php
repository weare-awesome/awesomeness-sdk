<?php

namespace WeAreAwesome\AwesomenessSDK\Endpoints;

use WeAreAwesome\AwesomenessSDK\Awesomeness;

class Contacts implements EndpointInterface
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
     * @param array $params
     *
     * @return \WeAreAwesome\AwesomenessSDK\Http\ApiResponse
     */
    public function get(array $params = [])
    {
        return $this->awesomeness
            ->http()
            ->sync()
            ->get(
                'contacts',
                $params
            );
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
                []
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
                $params
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

    /**
     * @param array $params
     *
     * @return \WeAreAwesome\AwesomenessSDK\Http\ApiResponse
     */
    public function create(array $params = [])
    {
        return $this->awesomeness
            ->http()
            ->sync($this->awesomeness->getClientAuthentication())
            ->post('contacts', $params);
    }
}