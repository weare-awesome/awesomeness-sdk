<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 05/04/18
 * Time: 09:10
 */

namespace WeAreAwesome\AwesomenessSDK\Http;

use WeAreAwesome\AwesomenessSDK\Authentication\Authentication;

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
     * @param Authentication|null $authentication
     *
     * @return ConnectionInterface
     */
    public function sync(Authentication $authentication = null)
    {
        $c = clone $this->sync;
        if($authentication) {
            $c->setAuthentication($authentication);
        }
        return $c;
    }

    /**
     * @param Authentication|null $authentication
     *
     * @return AsyncInterface
     */
    public function async(Authentication $authentication = null)
    {
        $c = clone $this->async;
        if($authentication) {
            $c->setAuthentication($authentication);
        }
        return clone $c;
    }

}