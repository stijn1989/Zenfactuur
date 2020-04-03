<?php
namespace Diagro\Zenfactuur\Entity;


class ApiToken extends BaseEntity
{


    public $username;


    public function getEmail()
    {
        return $this->username;
    }


}