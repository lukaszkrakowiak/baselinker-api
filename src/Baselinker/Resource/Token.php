<?php

namespace Baselinker\Resource;

use Baselinker\Interfaces\TokenInterface;

class Token implements TokenInterface{
    private $token;
    public function setToken($token):void{
        $this->token = $token;
    }

    public function getToken():string{
        return $this->token;
    }
}