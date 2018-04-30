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

}