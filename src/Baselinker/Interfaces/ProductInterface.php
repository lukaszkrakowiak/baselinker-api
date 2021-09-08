<?php

namespace Baselinker\Interfaces;

interface ProductInterface
{
    /**
     * Add filter to query
     *
     * @param  mixed $filter
     * @param  mixed $value
     * @return ProductInterface
     */
    public function addFilter($filter, $value): ProductInterface;
    /**
     * Inventory ID
     *
     * @param  mixed $inventory_id
     * @return ProductInterface
     */
    public function inventory($inventory_id): ProductInterface;
    /**
     * Where parameter is set
     *
     * @param  mixed $name
     * @param  mixed $value
     * @return ProductInterface
     */
    public function where($name, $value): ProductInterface;
    /**
     * Get product when find
     *
     * @return object
     */
    public function getProduct(): object;
    /**
     * Return true if is in inventory
     * 
     * @return bool
     */
    public function check(): bool;
}
