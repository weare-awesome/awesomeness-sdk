<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content;

use WeAreAwesome\AwesomenessSDK\Http\ApiResponse;

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
    }

    private static function makeContent($params)
    {
        $page = new Page();
        $page->setTitle($params['title']);
        $page->setBody($params['body']);
        $page->setSlug($params['slug']);
        $page->setPublishDate($params['publish_date']);
        $page->setSections(
            new SectionCollection(
                array_map(
                    function ($item) {
                        if($item['type'] == 'section') {
                            $section = new Section();
                            $section->setTitle($item['title']);
                            $section->setDisplayed((strtotime($item['publish_date']) < time()));
                            return $section;
                        }
                    },
                    $params['children']
                )
            )
        );
        return $page;
    }
}