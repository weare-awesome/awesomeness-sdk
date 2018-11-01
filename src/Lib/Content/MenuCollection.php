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
        return (array) $this->firstWhere('id', $id);
    }

    /**
     * @param $name
     * @return array
     */
    public function getByName($name)
    {
        return (array) $this->firstWhere('name', $name);
    }
}