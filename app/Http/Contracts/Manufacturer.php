<?php

namespace App\Http\Contracts;

interface Manufacturer
{
    /**
     * Get the manufacturer related to the product
     * 
     * @param  App\Product 	$product 
     * @return string
     */
    public function getManufacturer($product);
}
