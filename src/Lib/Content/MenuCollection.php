<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content;


use Illuminate\Support\Collection;

class MenuCollection extends Collection
{

    /**
     * @param $id
     * @return array
     */
    public function getById($id)
    {
        $menu = null;

        foreach ($this->all() as $item) {
            if ($item->getId() === $id) {
                $menu = $item;
            }
            break;
        }

        return $menu;
    }

    /**
     * @param $name
     * @return array
     */
    public function getByName($name)
    {
        return (array)$this->firstWhere('name', $name);
    }
}