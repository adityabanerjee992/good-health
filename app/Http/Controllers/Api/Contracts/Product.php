<?php namespace App\Http\Controllers\Api\Contracts;

interface Product
{

    /**
     * Gives back the search results for a given product query
     * 
     * @param  string   $query
     * @return json
     */
    public function search($query,\ProductTransformer $productTransformer);

    /**
     * Get all products
     * 
     * @return json
     */
    public function all(\ProductTransformer $productTransformer);

    /**
     * Get details of particular product
     * 
     * @param App\Acme\Transformers\ProductDetailsTransformer $productDetailsTransformer 
     * @return json
     */
    public function show(\ProductDetailsTransformer $productDetailsTransformer);
    
}