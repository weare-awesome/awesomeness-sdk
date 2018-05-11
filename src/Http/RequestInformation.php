<?php


namespace WeAreAwesome\AwesomenessSDK\Http;

class RequestInformation
{

    /**
     * @var string
     */
    protected $ip;

    /**
     * @var string
     */
    protected $referer;

    /**
     * @var integer
     */
    protected $distribution;

    /**
     * @var string
     */
    protected $client;

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return string
     */
    public function getReferer()
    {
        return $this->referer;
    }

    /**
     * @param string $referer
     */
    public function setReferer($referer)
    {
        $this->referer = $referer;
    }

    /**
     * @return int
     */
    public function getDistribution()
    {
        return $this->distribution;
    }

    /**
     * @param int $distribution
     */
    public function setDistribution($distribution)
    {
        $this->distribution = $distribution;
    }

    /**
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param string $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return RequestInformation
     */
    public static function make()
    {
        $r = new static();
        $r->setIp(self::getRealIp());
        $r->setReferer(@$_SERVER['HTTP_REFERER']);
        $r->setDistribution(@env('AWESOMENESS_DISTRIBUTION'));
        $r->setClient(@$_SERVER['HTTP_USER_AGENT']);

        return $r;
    }

    /**
     * @return string
     */
    public static function getRealIp()
    {

        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];


        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }

}