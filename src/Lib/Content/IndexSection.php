<?php


namespace WeAreAwesome\AwesomenessSDK\Lib\Content;


use Illuminate\Pagination\LengthAwarePaginator;

class IndexSection extends Section
{

    /**
     * @var LengthAwarePaginator
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
     * @return LengthAwarePaginator
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @return \Illuminate\Support\HtmlString
     */
    public function renderPagination($path = '')
    {
        $content = clone $this->pages;
        $content->withPath($path);
        return $content->links();
    }

    /**
     * @param null|LengthAwarePaginator $collection
     */
    public function setPages(?LengthAwarePaginator $collection)
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
}pub