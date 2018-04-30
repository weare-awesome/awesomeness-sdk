<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content\Types;

interface ContentTypeInterface
{

    /**
     * @param array $options
     *
     * @return string
     */
    public function render(array $options = []);
}