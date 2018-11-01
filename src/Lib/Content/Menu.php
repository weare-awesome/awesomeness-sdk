<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content;


use Illuminate\Support\Collection;

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
     * @var Collection
     */
    protected $menuItems;

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
     * @return Collection
     */
    public function getMenuItems(): Collection
    {
        return $this->menuItems;
    }

    /**
     * @param Collection $menuItems
     */
    public function setMenuItems(Collection $menuItems)
    {
        $this->menuItems = $menuItems;
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


        if(isset($params['menu_items'])) {
            $menu->setMenuItems(MenuItem::makeItems($params['menu_items']));
        }

        return $menu;
    }
}