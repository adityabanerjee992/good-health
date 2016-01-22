<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Contracts\Unit as UnitContract;

class UnitController extends Controller implements UnitContract
{
    
    /**
     * Get the unit related to the product
     * 
     * @param  App\Product 	$product 
     * @return string
     */
    public function getUnit($product)
    {
    	$unit=$product->units()->get()->toArray();
    	
    	return $unit[0]['unit_type'];
    }	

}
