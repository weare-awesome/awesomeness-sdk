<?php


namespace WeAreAwesome\AwesomenessSDK\Lib\Content;


use App\SiteConfig;
use WeAreAwesome\AwesomenessSDK\Http\ApiResponse;

class DistributionPage extends Page
{

    /**
     * @var MenuCollection
     */
    protected $menus;


    /**
     * @var SiteConfig
     */
    protected $config;


    /**
     * @return SiteConfig
     */
    public function config()
    {
        return $this->config;
    }

    /**
     * @param SiteConfig $config
     */
    public function setConfig(SiteConfig $config)
    {
        $this->config = $config;
    }


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
        $content = $response->getData()['content'];
        $page = PageFactory::makeFromArray(
            $content,
            json_decode($content['content_type']['cms_config'], true)
        );
        $distributionPage = self::castPageToDistributionPage($page);
        $distributionPage->setMenus(
            self::makeMenuCollection($response->getData()['menus'])
        );
        $distributionPage->setConfig(
            new SiteConfig($response->getData()['siteConfig'])
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