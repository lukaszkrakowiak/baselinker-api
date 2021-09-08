<?php

namespace Baselinker\Resource;

use Baselinker\Interfaces\ProductInterface;
use Baselinker\Resource\Method;
use Baselinker\Interfaces\TokenInterface;

class Product implements ProductInterface
{
    private $filter;
    private $inventory_id;
    private $where;
    private $product;
    private $token;


    public function __construct(TokenInterface $token)
    {
        $this->token = $token;
    }

    public function addFilter($filter, $value): ProductInterface
    {
        $this->filter[$filter] = $value;
        return $this;
    }

    public function inventory($inventory_id): ProductInterface
    {
        $this->inventory_id = $inventory_id;
        return $this;
    }

    public function where($name, $value): ProductInterface
    {
        $this->where[$name] = $value;
        return $this;
    }

    public function getProduct(): object
    {
        return $this->product;
    }


    /**
     * Return true if is in inventory
     * 
     * @return bool
     */
    public function check(): bool
    {
        $baselinker = new Method($this->token);

        $value = [
            "inventory_id" => $this->inventory_id,
        ];

        //stack all filter
        if (!empty($this->filter)) {
            foreach ($this->filter as $filter => $val) {
                $value["filter_" . $filter] = $val;
            }
        }

        $product = $baselinker->parameter("getInventoryProductsList", $value)->send();

        if (!empty($product->products)) {
            $p_ids = [];
            //All ID
            foreach ($product->products as $product_id => $null) {
                $p_ids[] = $product_id;
            }

            //Get all products where ID == all id
            $p_data = $baselinker->parameter("getInventoryProductsData", [
                "inventory_id" => $this->inventory_id,
                "products" => $p_ids
            ])->send();


            //Check if is product
            if (!empty($this->where)) {
                $count = count($this->where);
                foreach ($p_data->products as $pid => $pd) {
                    $c_tmp = 0;
                    //Loop for all parameters in product
                    foreach ($this->where as $key => $value) {
                        //If parameter == our where parameter
                        if ($pd->text_fields->features->$key == $value) {
                            //increment checked value
                            $c_tmp++;
                        }
                    }
                    //if checked value == all our where parameter
                    if ($c_tmp == $count) {
                        //set product to var
                        $pd->pid = $pid;
                        $this->product = $pd;

                        //return true
                        return true;
                    }
                }
            } else {
                foreach ($p_data->products as $pid => $pd) {
                    $pd->pid = $pid;
                    $this->product = $pd;

                    //return true
                    return true;
                }
            }
        }

        //if don't match then return false
        return false;
    }
}
