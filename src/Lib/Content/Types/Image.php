<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content\Types;

Class Image extends ContentItem implements ContentTypeInterface
{
    public function render(array $options = [])
    {
        return $this->body;
    }
}