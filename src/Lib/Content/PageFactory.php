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
            array_map(function ($item) {
                return self::makeContent($item);
            }, $items)
        );
    }


    /**
     * @param array $content
     * @return Page
     */
    public static function makeFromArray(array $content, array $config = null)
    {
        return self::makeContent($content, $config);
    }

    /**
     * @param $params
     *
     * @param array|null $config
     * @return Page
     */
    private static function makeContent($params, array $config = null)
    {
        $page = new Page();
        $page->setId($params['id']);
        $page->setTitle($params['title']);
        $page->setBody($params['body']);
        $page->setSlug($params['slug']);
        $page->setType($params['type']);
        if (isset($params['meta'])) {
            $page->setMeta(MetaCollection::makeFromArray($params['meta']));
        }
        $page->setPublishDate(new \DateTime($params['publish_date']));
        $page->setSections(
            new SectionCollection(
                self::mapSections($params['children'], $config)
            )
        );

        return $page;
    }

    /**
     * @param $content
     *
     * @return array
     */
    private static function mapSections($content, array $config = null)
    {
        return array_map(
            function ($item) use ($config) {
                if ($item['type'] == 'section') {

                    if (self::isSectionIndex($item, $config)) {
                        $section = new IndexSection();
                    } else {
                        $section = new Section();
                    }
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
     * @param array $section
     * @param array|null $config
     * @return bool
     */
    private static function isSectionIndex(array $section, array $config = null)
    {
        if (is_null($config)) {
            return false;
        }

        $sectionConfig = null;

        foreach ($config['sections'] as $item) {

            if($item['name'] === $section['title']) {
                $sectionConfig = $item;
            }
        }

        if(isset($sectionConfig['index'])) {
            return $sectionConfig['index'];
        }

        return false;
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