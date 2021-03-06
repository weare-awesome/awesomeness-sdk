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
     * @var ContentMap
     */
    protected $contentMap;


    /**
     * @var
     */
    protected $path;


    /**
     * @param null|string $path
     */
    public function setPath(?string $path) {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return !is_null($this->path) ? $this->path : '';
    }

    /**
     * @return ContentMap
     */
    public function getContentMap()
    {
        return $this->contentMap;
    }

    /**
     * @param ContentMap $contentMap
     */
    public function setContentMap($contentMap)
    {
        $this->contentMap = $contentMap;
    }

    /**
     * @return SectionCollection
     */
    public function getIndexSections()
    {
        return $this->sections->filter(function(Section $section) {
            return $section instanceof IndexSection;
        });
    }

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
        if(is_null($this->additionalContent)) {
            return new PageCollection();
        }
        return $this->additionalContent->filter(function ($item) use ($type) {
            return $item->getType() == $type;
        });
    }
}
