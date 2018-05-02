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
     * @var PageCollection
     */
    protected $additionalContent;

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
     * @param $title
     *
     * @return Section | null
     */
    public function section($title)
    {
        return $this->sections->first(function(Section $section) use($title) {
            return $section->getTitle() == $title;
        });
    }

    /**
     * @param SectionCollection $sections
     */
    public function setSections($sections)
    {
        $this->sections = $sections;
    }

    /**
     * @return PageCollection
     */
    public function getAdditionalContent()
    {
        return $this->additionalContent;
    }

    /**
     * @param PageCollection $additionalContent
     */
    public function setAdditionalContent(PageCollection $additionalContent)
    {
        $this->additionalContent = $additionalContent;
    }

    /**
     * @param PageCollection $additionalContent
     */
    public function addAdditionalContent(PageCollection $additionalContent)
    {
        if($this->additionalContent) {
            $this->additionalContent = $this->additionalContent
                ->merge($additionalContent);
        }else {
            $this->setAdditionalContent($additionalContent);
        }
    }

    /**
     * @param $type
     *
     * @return PageCollection
     */
    public function getAdditionalContentByType($type)
    {
        return $this->additionalContent->filter(function ($item) use ($type) {
            return $item->getType() == $type;
        });
    }
}
