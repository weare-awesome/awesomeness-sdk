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

    /**
     * @param $name
     *
     * @return mixed|null
     */
    public function getType($name)
    {
        return isset($this->items[$name]) ? $this->items[$name] : null;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * @param ApiResponse $apiResponse
     *
     * @return ContentMap
     */
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