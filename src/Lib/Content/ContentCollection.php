<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content;


use Illuminate\Support\Collection;
use WeAreAwesome\AwesomenessSDK\Lib\Content\Types\ContentItem;

class ContentCollection extends Collection
{

    /**
     * @param callable|null $function
     *
     * @return array
     */
    public function renderAll(callable $function = null)
    {
        return $this->map(function(ContentItem $item) use($function) {
            if($function){
                return $function($item);
            }
            return $item->render();
        })->toArray();
    }
}