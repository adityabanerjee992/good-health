<?php

namespace App\Http\Contracts;

interface Classes
{
     /**
     * Get the classes related to a particular product
     * 
     * @param  App/Product  $product
     * @return string
     */
    public function getClasses($product);
}