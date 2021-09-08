<?php

namespace Baselinker\Interfaces;


use Baselinker\Interfaces\TokenInterface;

interface MethodInterface{        
    /**
     * method
     *
     * @param  mixed $method
     * @param  mixed $param
     * @return MethodInterface
     */
    public function __construct(TokenInterface $token);

    
    /**
     * parameter
     *
     * @param  mixed $method
     * @param  mixed $param
     * @return MethodInterface
     */
    public function parameter($method, $param):MethodInterface;
    /**
     * send
     *
     * @return object
     */
    public function send():object;
}