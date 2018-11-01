<?php


namespace WeAreAwesome\AwesomenessSDK\Lib\Content;


use WeAreAwesome\AwesomenessSDK\Http\ApiResponse;

class DistributionPage extends Page
{


    /**
     * @param ApiResponse $response
     * @return DistributionPage
     */
    public static function makeFromApiResponse(ApiResponse $response) {
        $page = PageFactory::makeFromArray($response->getData()['content']);
        $distributionPage = self::castPageToDistributionPage($page);
        return $distributionPage;
    }

    /**
     * @param Page $page
     * @return DistributionPage
     */
    public static function castPageToDistributionPage(Page $page) {
        $distributionPage = new DistributionPage();
        $distributionPage->setId($page->getId());
        $distributionPage->setSlug($page->getSlug());
        $distributionPage->setTitle($page->getTitle());
        $distributionPage->setBody($page->getBody());
        $distributionPage->setType($page->getType());
        $distributionPage->setMeta($page->getMeta());
        $distributionPage->setPath($page->getPath());
        $distributionPage->setPublishDate($page->getPublishDate());
        $distributionPage->setSections($page->getSections());
        return $distributionPage;
    }

}