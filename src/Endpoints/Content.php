<?php


namespace WeAreAwesome\AwesomenessSDK\Endpoints;

use WeAreAwesome\AwesomenessSDK\Awesomeness;
use WeAreAwesome\AwesomenessSDK\Http\RequestInformation;
use WeAreAwesome\AwesomenessSDK\Lib\Content\ContentCollection;
use WeAreAwesome\AwesomenessSDK\Lib\Content\Page;
use WeAreAwesome\AwesomenessSDK\Lib\Content\PageCollection;
use WeAreAwesome\AwesomenessSDK\Lib\Content\PageFactory;

class Content implements EndpointInterface
{

    /**
     * @var Awesomeness
     */
    protected $awesomeness;

    /**
     * Content constructor.
     *
     * @param Awesomeness $awesomeness
     */
    public function __construct(Awesomeness $awesomeness)
    {
        $this->awesomeness = $awesomeness;
    }

    /**
     * @param $slug
     * @param null $type
     * @param null $distributionId
     * @param array $additionalContent
     *
     * @return \WeAreAwesome\AwesomenessSDK\Lib\Content\Page|\WeAreAwesome\AwesomenessSDK\Lib\Content\PageCollection
     */
    public function  getPageBySlug(
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

        $pageRequest = $requests->get('/content/slug', array_merge($params ,[
            'content_view' => (RequestInformation::make())->toArray()
        ]));
        $contentRequests = [];

        if($additionalContent) {
            foreach ($additionalContent as $params) {
                $contentRequests[] = $requests->get('content', $params);
            }
        }
        $requests->call();

        $page = PageFactory::makeFromApiResponse($pageRequest->getResponse());

        foreach ($contentRequests as $contentRequest) {
            if($content = PageFactory::makeFromApiResponse($contentRequest->getResponse())) {
                if($content instanceof Page) {
                    $content = PageCollection::make([$content]);
                }
                $page->addAdditionalContent($content);
            }
        }

        return $page;
    }

    /**
     * @param $slug
     * @param null $type
     * @param null $distributionId
     * @param array $additionalContent
     */
    public function getBySlug(
        $slug,
        $type = null,
        $distributionId = null,
        array $additionalContent = []
    ) {

    }

}