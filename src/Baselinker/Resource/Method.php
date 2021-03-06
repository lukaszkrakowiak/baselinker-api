<?php

namespace Baselinker\Resource;

use Baselinker\Interfaces\MethodInterface;
use Baselinker\Interfaces\TokenInterface;

class Method implements MethodInterface
{
    const METHOD_ADD_INVENTORY_PRICE_GROUP = "addInventoryPriceGroup";
    const METHOD_DELETE_INVENTORY_PRICE_GROUP = "deleteInventoryPriceGroup";
    const METHOD_GET_INVENTORY_PRICE_GROUPS = 'getInventoryPriceGroups';
    const METHOD_ADD_INVENTORY_WAREHOUSE = 'addInventoryWarehouse';
    const METHOD_DELETE_INVENTORY_WAREHOUSE = 'deleteInventoryWarehouse';
    /**
     * Todo: fill up this const value
     */

    /**
     * parameter
     *
     * @var array
     */
    private $parameter;
    private $token;

    public function __construct(TokenInterface $token){
        $this->token = $token->getToken();
    }

    public function parameter($method, $param):MethodInterface{
        $this->parameter = [
            "method" => $method,
            "parameters" => json_encode($param),
        ];
        return $this;
    }
    
    /**
     * send
     *
     * @return object
     */
    public function send(): object
    {
        $query = http_build_query($this->parameter);
        $contextData = array(
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                "Content-Length: ".strlen($query)."\r\n".
                "X-BLToken: ".$this->token,
            'content' => $query
        );

        $result =  file_get_contents('https://api.baselinker.com/connector.php', false, stream_context_create(array('http' => $contextData)));
        return json_decode($result);
    }
}
