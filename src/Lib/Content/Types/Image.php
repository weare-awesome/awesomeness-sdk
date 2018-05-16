<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content\Types;

Class Image extends ContentItem implements ContentTypeInterface
{
    public function render(array $options = [])
    {
        return "<img src='$this->body' alt='$this->title'>";
    }
}