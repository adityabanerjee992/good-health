<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Contracts\Manufacturer as ManufacturerContract;

class ManufacturerController extends Controller implements ManufacturerContract
{
    /**
     * Get the manufacturer related to the product
     * 
     * @param  App\Product 	$product 
     * @return string
     */
    public function getManufacturer($product)
    {
    	$manufacturer=$product->manufacturers()->get()->toArray();
    	
    	return $manufacturer[0]['manufacturer_name'];
    }	
}
