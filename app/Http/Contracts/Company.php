<?php

namespace App\Http\Contracts;

interface Company
{

    /**
     * Get the company related to the product
     * 
     * @param  App\Product 	$product 
     * @return string
     */
    public function getCompany($product);	
}