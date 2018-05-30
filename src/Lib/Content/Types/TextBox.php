<?php


namespace WeAreAwesome\AwesomenessSDK\Lib\Content\Types;

class TextBox extends ContentItem implements ContentTypeInterface
{
    public function render(array $options = [])
    {
        return $this->body;
    }

}