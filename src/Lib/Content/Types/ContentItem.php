<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content\Types;

use WeAreAwesome\AwesomenessSDK\Lib\Content\MetaCollection;

class ContentItem
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var MetaCollection
     */
    protected $meta;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var \DateTime
     */
    protected $publishDate;

    /**
     * @var int
     */
    protected $order;

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
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return MetaCollection
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param MetaCollection $meta
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return \DateTime
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * @param \DateTime $publishDate
     */
    public function setPublishDate($publishDate)
    {
        $this->publishDate = $publishDate;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @param $params
     *
     * @return null|ContentItem
     */
    public static function make($params)
    {
        $item = null;

        switch ($params['type']) {
            case('html'):
                $item = new HTML();
                break;
        }
        if(!is_null($item)) {
            $item->setTitle($params['title']);
            $item->setBody($params['body']);
            $item->setOrder($params['order']);
        }

        return $item;
    }
}