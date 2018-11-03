<?php


namespace App;


class SiteConfig
{
    /**
     * @var array
     */
    private $sections;


    /**
     * SiteConfig constructor.
     * @param array $sections
     */
    public function __construct(array $sections = [])
    {
        $this->sections = $sections;
    }

    /**
     * @param $section
     * @param $key
     * @return string
     */
    public function get($section, $key)
    {
        if(
            isset($this->sections[$section])
            && isset($this->sections[$section][$key])
        ) {
            return $this->sections[$section][$key];
        }
        return '';
    }



    /**
     * @return array
     */
    public function toArray()
    {
        return $this->sections;
    }
}