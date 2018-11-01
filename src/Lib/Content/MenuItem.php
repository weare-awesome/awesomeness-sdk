<?php


namespace WeAreAwesome\AwesomenessSDK\Lib\Content;


use Illuminate\Support\Collection;

class MenuItem
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var integer
     */
    protected $contentId;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var bool
     */
    protected $index;


    /**
     * @var Collection
     */
    protected $children;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getContentId(): int
    {
        return $this->contentId;
    }

    /**
     * @param int $contentId
     */
    public function setContentId(int $contentId)
    {
        $this->contentId = $contentId;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return bool
     */
    public function isIndex() : bool
    {
        return $this->index;
    }

    /**
     * @param bool $index
     */
    public function setIndex(bool $index)
    {
        $this->index = $index;
    }

    /**
     * @return Collection
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @param Collection $children
     */
    public function setChildren(Collection $children)
    {
        $this->children = $children;
    }


    /**
     * @param array $params
     * @return MenuItem
     */
    public static function make(array $params = [])
    {
        $menu = new static();
        $menu->setTitle($params['title']);
        $menu->setPath($params['path']);
        $menu->setIndex($params['index']);
        $menu->setChildren(
            self::makeItems($params['menu_items'])
        );

        return $menu;
    }

    /**
     * @param array $items
     * @return Collection
     */
    public static function makeItems(array $items = [])
    {
        $menuItemsCollection = new Collection();
        foreach ($items as $item) {
            $menuItemsCollection = $menuItemsCollection->merge([
                self::make($item)
            ]);
        }

        return $menuItemsCollection;
    }
}