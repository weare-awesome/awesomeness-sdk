<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content\Types;

Class Video extends ContentItem implements ContentTypeInterface
{
    public function render(array $options = [])
    {
        return $this->body;
    }
}