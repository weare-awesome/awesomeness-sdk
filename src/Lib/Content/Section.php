<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content;

use WeAreAwesome\AwesomenessSDK\Lib\Content\Types\ContentItem;

class Section
{

    /**
     * @var string
     */
    protected $title;

    /**
     * @var boolean
     */
    protected $displayed;

    /**
     * @var ContentCollection
     */
    protected $content;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return bool
     */
    public function isDisplayed()
    {
        return $this->displayed;
    }

    /**
     * @param bool $displayed
     */
    public function setDisplayed($displayed)
    {
        $this->displayed = $displayed;
    }

    /**
     * @return ContentCollection
     */
    public function content()
    {
        return $this->content;
    }

    /**
     * @param ContentCollection $content
     */
    public function setContent(ContentCollection $content)
    {
        $this->content = $content;
    }

    /**
     * @param $title
     *
     * @return string
     */
    public function getRaw($title)
    {
        $content = $this->content->first(function(ContentItem $item) use($title) {
            return $item->getTitle() == $title;
        });

        return $content ? $content->getBody() : '';
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->content->all();
    }
}
