<?php



namespace WeAreAwesome\AwesomenessSDK\Lib\Content;

use WeAreAwesome\AwesomenessSDK\Http\ApiResponse;

class ContentMap
{
    /**
     * @var array
     */
    protected $items;

    /**
     * ContentMap constructor.
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getType($name)
    {
        return isset($this->items[$name]) ? $this->items[$name] : null;
    }


    public static function makeFromResponse(ApiResponse $apiResponse)
    {
        $data = $apiResponse->getData();
        $formatted = [];
        foreach ($data as $item) {
            $formatted[$item['type']] = $item['items'];
        }

        return new static($formatted);
    }
}