<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content;


class Menu
{


    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return strin
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param strin $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }


    /**
     * @param array $params
     * @return Menu
     */
    public static function make(array $params = [])
    {
        $menu  = new static();
        if(isset($params['id'])) {
            $menu->setId($params['id']);
        }
        if(isset($params['name'])) {
            $menu->setName($params['name']);
        }

        return $menu;
    }
}