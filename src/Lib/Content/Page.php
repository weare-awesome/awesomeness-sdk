<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content;

use WeAreAwesome\AwesomenessSDK\Lib\Content\Types\ContentItem;

class Page extends ContentItem
{

    /**
     * @var SectionCollection
     */
    protected $sections;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->body;
    }
    /**
     * @return SectionCollection
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param SectionCollection $sections
     */
    public function setSections($sections)
    {
        $this->sections = $sections;
    }
}
