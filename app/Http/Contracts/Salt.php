<?php

namespace App\Http\Contracts;

interface Salt
{
	/**
	 * Get salts by ailment id
	 * @param   integer 	$id 
	 * @return  /Illuminate/View
	 */
    public function getSaltsByAilments($id);

    /**
     * Get salts by class id
     * @param   integer     $id 
     * @return  /Illuminate/View
     */
    public function getSaltsByClass($id);

    /**
     * Get the salts related to a particular product
     * 
     * @param  App/Product  $product
     * @return string
     */
    public function getSalts($product);
}