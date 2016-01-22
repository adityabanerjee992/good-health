<?php

namespace App\Http\Contracts;

interface Packing
{
    /**
     * Get the packing related to the product
     * 
     * @param  App\Product 	$product 
     * @return string
     */
    public function getPacking($product);
    
}