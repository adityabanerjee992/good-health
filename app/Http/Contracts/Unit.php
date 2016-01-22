<?php

namespace App\Http\Contracts;

interface Unit
{
    /**
     * Get the unit related to the product
     * 
     * @param  App\Product 	$product 
     * @return string
     */
    public function getUnit($product);
}