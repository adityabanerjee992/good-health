<?php

namespace App\Http\Contracts;

interface ProductType
{
     /**
     * Get the product type
     * 
     * @param  App/Product  $product
     * @return string
     */
    public function getProductType($product);
    
}