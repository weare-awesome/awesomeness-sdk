<?php


namespace WeAreAwesome\AwesomenessSDK\Endpoints;

use WeAreAwesome\AwesomenessSDK\Awesomeness;
use WeAreAwesome\AwesomenessSDK\Lib\Content\PageFactory;

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

        $pageRequest = $requests->get('/content/slug', ['slug' => $slug]);

        $contentRequests = [];

        if($additionalContent) {
            foreach ($additionalContent as $params) {
                $contentRequests[] = $requests->get('content', $params);
            }
        }
        $requests->call();

        $page = PageFactory::makeFromApiResponse($pageRequest->getResponse());
    }

    public function getBySlug(
        $slug,
        $type = null,
        $distributionId = null,
        array $additionalContent = []
    ) {

    }

}