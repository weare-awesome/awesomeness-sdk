<?php

namespace WeAreAwesome\AwesomenessSDK\Endpoints;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use WeAreAwesome\AwesomenessSDK\Awesomeness;
use WeAreAwesome\AwesomenessSDK\Exceptions\ContentNotFoundException;
use WeAreAwesome\AwesomenessSDK\Http\RequestInformation;
use WeAreAwesome\AwesomenessSDK\Lib\Content\ContentCollection;
use WeAreAwesome\AwesomenessSDK\Lib\Content\ContentMap;
use WeAreAwesome\AwesomenessSDK\Lib\Content\DistributionPage;
use WeAreAwesome\AwesomenessSDK\Lib\Content\IndexSection;
use WeAreAwesome\AwesomenessSDK\Lib\Content\Page;
use WeAreAwesome\AwesomenessSDK\Lib\Content\PageCollection;
use WeAreAwesome\AwesomenessSDK\Lib\Content\PageFactory;
use Carbon\Carbon;

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
     * @throws ContentNotFoundException
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

        if ($includeMap) {
            $mapRequest = $requests->get('content/map');
        }

        $requests->call();


        if ($pageRequest->getResponse()->getCode() !== 200) {
            throw new ContentNotFoundException('The content you requested can\'t bew found');
        }

        $page = PageFactory::makeFromApiResponse($pageRequest->getResponse());

        if (!is_null($mapRequest) && !is_null($page)) {
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
     * @param $distributionId
     * @param $path
     * @param int $page
     * @return int|DistributionPage
     * @throws ContentNotFoundException
     */
    public function getDistributionPage(
        $distributionId,
        $path,
        $page = 1
    ) {

        $response = $this->awesomeness
            ->http()
            ->sync()
            ->get('/content/page', [
                'distribution_id' => $distributionId,
                'path' => $path
            ]);

        if ($response->getCode() !== 200) {
            throw new ContentNotFoundException('The content you requested can\'t bew found');
        }

        $page = DistributionPage::makeFromApiResponse($response);
        $page->getIndexSections()->each(function (IndexSection $section) use ($distributionId) {
            $type = $section->getContentType();
            if (is_null($type)) {
                return;
            }
            $params = [
                'types' => [$type],
                'page' => $section->isPaginated() ? $page : 1,
                'limit' => $section->getPerPage(),
                'publish_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'distribution_id' => $distributionId
            ];

            $response = $this->awesomeness
                ->http()
                ->sync()
                ->get('/content', $params);

            $section->setPages(
                new LengthAwarePaginator(
                    PageCollection::make(
                        array_map(function ($item) {
                            return PageFactory::makeFromArray($item);
                        }, $response->getData())
                    ),
                    200,
                    $response->getPagination()['per_page'],
                    $response->getPagination()['current_page']

                )
            );

        });
        return $page;
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
            $pagination['total'],
            $pagination['per_page'],
            $pagination['current_page']
        );

        return $content;
    }

}