<?php

namespace App\Http\Contracts;

interface Product
{
    /**
     * Get al products under a particular salt id
     * 
     * @param   integer     $saltId
     * @return  \Illuminate\view 
     */
    public function getProductsBySalt($id);

    /**
     * Get the product detailes by its Id
     * 
     * @param   integer     $id
     * @return  \Illuminate\View
     */
    public function getProductDetailes($id);

    /**
     * Fetch the product detailes by its Id
     * 
     * @param   integer     $id
     * @return  \Illuminate\View
     */
    public function fetchProductDetails($id);

    /**
     * List all the products 
     * 
     * @return \Illuminate\View
     */
    public function listProducts();    
}