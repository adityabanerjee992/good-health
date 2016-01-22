<?php

namespace App\Http\Contracts;

interface Category
{
    /**
     * Get the categories related to the product
     * 
     * @param  App\Product 	$product 
     * @return string
     */
    public function getCategories($product);
}