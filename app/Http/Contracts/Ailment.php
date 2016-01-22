<?php

namespace App\Http\Contracts;

interface Ailment
{
     /**
     * Get the ailments related to a particular product
     * 
     * @param  App/Product  $product
     * @return string
     */
    public function getAilments($product);
}