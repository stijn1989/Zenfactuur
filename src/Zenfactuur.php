<?php
namespace Diagro;

use Diagro\Zenfactuur\Api\Client;
use Diagro\Zenfactuur\Api\Invoice;

class Zenfactuur
{


    /**
     * Zenfactuur API token
     *
     * @var string
     */
    private $token;


    public function __construct($token)
    {
        $this->token = $token;
    }


    protected function getToken()
    {
        return $this->token;
    }


    public function client()
    {
        return new Client($this->getToken());
    }


    public function invoice()
    {
        return new Invoice($this->getToken());
    }


}