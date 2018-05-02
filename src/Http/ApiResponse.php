<?php


namespace WeAreAwesome\AwesomenessSDK\Http;

use GuzzleHttp\Psr7\Response;

/**
 * Class ApiResponse
 * @package WeAreAwesome\AwesomenessSDK\Http
 */
class ApiResponse
{

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */#
    protected $message;

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var int
     */
    protected $code;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $pagination;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public function getDataByKey($key)
    {
        if(isset($this->data[$key])) {
            return $this->data[$key];
        }
        return null;
    }

    /**
     * @return array
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * @param array $pagination
     */
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * @param Response $response
     *
     * @return ApiResponse
     */
    public static function makeFromPsr7Response(Response $response)
    {
        $body = json_decode($response->getBody(), true);

        $apiResponse = new static();

        $apiResponse->setMessage($body['message']);
        $apiResponse->setCode($body['code']);
        $apiResponse->setData($body['data']);
        $apiResponse->setErrors($body['errors']);
        $apiResponse->setDescription($body['description']);
        if(isset($body['pagination'])) {
            $apiResponse->setPagination($body['pagination']);
        }

        return $apiResponse;
    }
}
