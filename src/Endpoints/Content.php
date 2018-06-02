<?php

namespace WeAreAwesome\AwesomenessSDK\Endpoints;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use WeAreAwesome\AwesomenessSDK\Awesomeness;
use WeAreAwesome\AwesomenessSDK\Http\RequestInformation;
use WeAreAwesome\AwesomenessSDK\Lib\Content\ContentCollection;
use WeAreAwesome\AwesomenessSDK\Lib\Content\ContentMap;
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
     * @param bool $includeMap
     *
     * @return \WeAreAwesome\AwesomenessSDK\Lib\Content\Page|\WeAreAwesome\AwesomenessSDK\Lib\Content\PageCollection
     */
    public function getPageBySlug(
        $slug,
        $type = null,
        $distributionId = null,
        array $additionalContent = [],
        $includeMap = true
    ) {
        $params = [
            'slug' => $slug
        ];

        if ($type) {
            $params['type'] = $type;
        }

        if ($distributionId) {
            $params['distribution_id'] = $distributionId;
        }
        $requests = $this->awesomeness->http()->async();

        $pageRequest = $requests->get('/content/slug', array_merge($params, [
            'content_view' => (RequestInformation::make())->toArray()
        ]));


        $contentRequests = [];

        if ($additionalContent) {
            foreach ($additionalContent as $params) {
                $contentRequests[] = $requests->get('content', $params);
            }
        }

        $mapRequest = null;

        if($includeMap) {
            $mapRequest = $requests->get('content/map');
        }

        $requests->call();

        $page = PageFactory::makeFromApiResponse($pageRequest->getResponse());

        if(!is_null($mapRequest) && !is_null($page)) {
            $page->setContentMap(ContentMap::makeFromResponse($mapRequest->getResponse()));

        }

        foreach ($contentRequests as $contentRequest) {
            if ($content = PageFactory::makeFromApiResponse($contentRequest->getResponse())) {
                if ($content instanceof Page) {
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

    /**
     * @param array $params
     *
     * @return LengthAwarePaginator|null
     */
    public function index(array $params = [])
    {
        $response = $this->awesomeness
            ->http()
            ->sync()
            ->get('content', $params);

        if ($response->getCode() !== 200) {
            return null;
        }

        $content = PageFactory::makeFromApiResponse($response);
        $pagination = $response->getPagination();
        $content = new LengthAwarePaginator(
            $content,
            100,
            $pagination['per_page'],
            $pagination['current_page']
        );

        return $content;
    }

}