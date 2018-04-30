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
}
