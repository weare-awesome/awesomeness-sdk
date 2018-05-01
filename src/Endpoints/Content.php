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


    public function getPageBySlug(
        $slug,
        $type = null,
        $distributionId = null,
        array $additionalContent = []
    )
    {
        $response = $this->getPageBySlug(
            $slug,
            $type,
            $distributionId,
            $additionalContent
        );

        dd($response);

    }

    public function getBySlug(
        $slug,
        $type = null,
        $distributionId = null,
        array $additionalContent = []
    ) {
        $params = [
            'slug' => $slug
        ];

        if($type) {
            $params['type'] = $type;
        }

        if($distributionId) {
            $params['distribution_id'] = $distributionId;
        }
        $requests = $this->awesomeness->http()->async();

        $page = $requests->get('/content/slug', ['slug' => $slug]);

        $requests->call();
    }

}