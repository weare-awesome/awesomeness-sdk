<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content;

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
}
