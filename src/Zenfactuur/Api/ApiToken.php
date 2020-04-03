<?php
namespace Diagro\Zenfactuur\Api;

use Diagro\Zenfactuur\Entity\ApiToken as ApiTokenEntity;
use Diagro\Zenfactuur\Exception;


class ApiToken extends BaseZenfactuur
{


    /**
     * Vraag username/email op.
     *
     * @return ApiTokenEntity
     * @throws Exception
     */
    public function getApiToken()
    {
        $data = $this->get('api_tokens');
        return new ApiTokenEntity($data);
    }


}