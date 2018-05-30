<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content\Types;

use WeAreAwesome\AwesomenessSDK\Lib\Content\MetaCollection;

class ContentItem implements ContentTypeInterface
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $type;

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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    public function render(array $options = [])
    {

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
            case('image'):
                $item = new Image();
                break;
            case('video'):
                $item = new Video();
                break;
            case('text'):
                $item = new Text();
                break;
            case('link'):
                $item = new Link();
                break;
            case('text-box'):
                $item = new TextBox();
                break;
            default:
                $item = new static();
                break;
        }
        if(!is_null($item)) {
            $item->setId($params['id']);
            $item->setTitle($params['title']);
            $item->setBody($params['body']);
            $item->setType($params['type']);
            $item->setOrder($params['order']);
        }

        return $item;
    }
}