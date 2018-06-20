<?php

namespace WeAreAwesome\AwesomenessSDK\Lib\Content;

class Meta
{

    /**
     * @var string
     */
    protected $key;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }




    public static function make($key, $value)
    {
        $n = new static();
        $n->setKey($key);
        $n->setValue($value);
        return $n;
    }

}