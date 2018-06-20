<?php


namespace WeAreAwesome\AwesomenessSDK\Lib\Content;

use Illuminate\Support\Collection;

class MetaCollection extends Collection
{
    /**
     * @param array|null $items
     *
     * @return MetaCollection
     */
    public static function makeFromArray(array $items = null)
    {
        $collection = self::make();
        if(!is_array($items)) {
            return $collection;
        }

        foreach ($items as $key => $value) {
            $collection = self::make([Meta::make($key, $value)]);
        }

        return $collection;
    }
}