<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content;

use WeAreAwesome\AwesomenessSDK\Http\ApiResponse;
use WeAreAwesome\AwesomenessSDK\Lib\Content\Types\ContentItem;

class PageFactory
{

    /**
     * @param ApiResponse $response
     *
     * @return Page | PageCollection
     */
    public static function makeFromApiResponse(ApiResponse $response)
    {
        $items = $response->getData();
        if (count($items) == 0) {
            return null;
        }
        if (count($items) == 1) {
            return self::makeContent($items[0]);
        }
        return new PageCollection(
            array_map(function($item){
                return self::makeContent($item);
            }, $items)
        );
    }


    /**
     * @param array $content
     * @return Page
     */
    public static function makeFromArray(array $content)
    {
        return self::makeContent($content);
    }

    /**
     * @param $params
     *
     * @return Page
     */
    private static function makeContent($params)
    {
        $page = new Page();
        $page->setId($params['id']);
        $page->setTitle($params['title']);
        $page->setBody($params['body']);
        $page->setSlug($params['slug']);
        $page->setType($params['type']);
        if(isset($params['meta'])) {
            $page->setMeta(MetaCollection::makeFromArray($params['meta']));
        }        $page->setPublishDate(new \DateTime($params['publish_date']));
        $page->setSections(
            new SectionCollection(
                self::mapSections($params['children'])
            )
        );

        return $page;
    }

    /**
     * @param $content
     *
     * @return array
     */
    private static function mapSections($content)
    {
        return array_map(
            function ($item) {
                if ($item['type'] == 'section') {
                    $section = new Section();
                    $section->setTitle($item['title']);
                    $section->setDisplayed(is_null($item['publish_date']) ? true : (strtotime($item['publish_date']) < time()));
                    $section->setContent(new ContentCollection(
                        self::mapContent($item['children'])
                    ));

                    return $section;
                }
            },
            $content);
    }

    /**
     * @param $content
     *
     * @return array
     */
    private static function mapContent($content)
    {
        return array_map(function ($item) {
            return ContentItem::make($item);
        }, $content);
    }
}