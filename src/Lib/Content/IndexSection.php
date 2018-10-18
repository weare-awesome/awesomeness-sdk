<?php


namespace WeAreAwesome\AwesomenessSDK\Lib\Content;


class IndexSection extends Section
{


    /**
     * @var PageCollection
     */
    protected $pages;


    /**
     * @return array
     */
    public function allPages()
    {
        return $this->pages ? $this->pages->all() : [];
    }


    /**
     * @param null|PageCollection $collection
     */
    public function setPages(?PageCollection $collection)
    {
        $this->pages = $collection;
    }

    /**
     * @return null|string
     */
    public function getContentType() {
        $type = $this->getRaw('content type');

        if(strlen($type) >= 1) {
            return $type;
        }
        return null;
    }


    /**
     * @return int|null
     */
    public function getPerPage()
    {
        $value = $this->getRaw('per page');

        if(strlen($value) >= 1) {
            return (int) $value;
        }
        return null;
    }

    /**
     * @return bool
     */
    public function isPaginated()
    {
        $value = $this->getRaw('paginated');

        if(strlen($value) >= 1) {
            return $value === 'y';
        }
        return false;
    }
}