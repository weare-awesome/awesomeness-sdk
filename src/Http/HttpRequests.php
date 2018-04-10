<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 05/04/18
 * Time: 09:10
 */

namespace WeAreAwesome\AwesomenessSDK\Http;

class HttpRequests
{

    const ACCOUNT_HEADER = 'authentication-account-id';

    /**
     * @var ConnectionInterface
     */
    protected $sync;

    /**
     * @var AsyncInterface
     */
    protected $async;

    /**
     * HttpRequests constructor.
     *
     * @param ConnectionInterface $sync
     * @param AsyncInterface $async
     */
    public function __construct(ConnectionInterface $sync, AsyncInterface $async)
    {
        $this->sync = $sync;
        $this->async = $async;
    }

    /**
     * @return ConnectionInterface
     */
    public function sync()
    {
        return $this->sync;
    }

    /**
     * @return AsyncInterface
     */
    public function async()
    {
        return $this->async;
    }

}