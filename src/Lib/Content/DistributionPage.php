<?php


namespace WeAreAwesome\AwesomenessSDK\Lib\Content;


use WeAreAwesome\AwesomenessSDK\Http\ApiResponse;

class DistributionPage extends Page
{

    /**
     * @var MenuCollection
     */
    protected $menus;


    /**
     * @return MenuCollection
     */
    public function getMenus(): MenuCollection
    {
        return $this->menus;
    }

    /**
     * @param MenuCollection $menus
     */
    public function setMenus(MenuCollection $menus)
    {
        $this->menus = $menus;
    }


    /**
     * @param ApiResponse $response
     * @return DistributionPage
     */
    public static function makeFromApiResponse(ApiResponse $response)
    {
        $page = PageFactory::makeFromArray($response->getData()['content']);
        $distributionPage = self::castPageToDistributionPage($page);
        $distributionPage->setMenus(
            self::makeMenuCollection($response->getData()['menus'])
        );
        return $distributionPage;
    }


    /**
     * @param array $menus
     * @return MenuCollection
     */
    private static function makeMenuCollection(array $menus = [])
    {

        $collection = new MenuCollection();

        foreach ($menus as $menu) {
            $collection = $collection->merge([
                Menu::make($menu)
            ]);
        }

        return $collection;
    }

    /**
     * @param Page $page
     * @return DistributionPage
     */
    public static function castPageToDistributionPage(Page $page)
    {
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