<?php
namespace Diagro\Zenfactuur\Entity;


abstract class BaseEntity
{


    public function __construct(array $data = [])
    {
        $this->build($data);
    }


    protected function build(array $data)
    {
        foreach ($data as $k => $v) {
            $this->$k = $v;
        }
    }


}