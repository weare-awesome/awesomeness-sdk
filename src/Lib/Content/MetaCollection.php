<?php


namespace WeAreAwesome\AwesomenessSDK\Lib\Content;

use Illuminate\Support\Collection;

class MetaCollection extends Collection
{

    /**
     * @param mixed $key
     * @param null $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        foreach ($this->items as $item) {
            if($item->getKey() == $key) {
                return $item;
            }
        }
        return value($default);
    }

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