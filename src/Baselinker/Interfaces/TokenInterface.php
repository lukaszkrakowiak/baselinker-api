<?php

namespace Baselinker\Interfaces;

interface TokenInterface{
    public function setToken($token):void;
    public function getToken():string;
}