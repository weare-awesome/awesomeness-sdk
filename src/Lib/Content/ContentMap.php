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


    public static function makeFromResponse(ApiResponse $apiResponse)
    {
        $data = $apiResponse->getData();

        dd($data);
    }
}