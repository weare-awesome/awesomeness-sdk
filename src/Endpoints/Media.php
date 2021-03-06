<?php

namespace WeAreAwesome\AwesomenessSDK\Endpoints;

use WeAreAwesome\AwesomenessSDK\Awesomeness;

class Media implements EndpointInterface
{

    /**
     * @var Awesomeness
     */
    protected $awesomeness;

    public function __construct(Awesomeness $awesomeness)
    {
        $this->awesomeness = $awesomeness;
    }

    public function upload(
        $fileContents,
        $name,
        $mimeType,
        $type,
        $public = false
    ) {
        $con = $this->awesomeness
            ->http()
            ->sync();

        $con->addHeader('guru-file-type', $mimeType);

        $response = $con->sendFile(
            '/media?' . http_build_query([
                'type' => $type,
                'name' => $name,
                'is_public' => $public
            ]),
            $fileContents
        );

        return $response;
    }
}