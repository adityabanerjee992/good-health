<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Contracts\Packing as PackingContract;

class PackingController extends Controller implements PackingContract
{    
    /**
     * Get the packing related to the product
     * 
     * @param  App\Product 	$product 
     * @return string
     */
    public function getPacking($product)
    {
    	$packings=$product->packings()->get();
    
        $strPackings=null;

        foreach ($packings as $packing) {
            
            $strPackings.= $packing->packing_type.'+';  
        }

        return trim($strPackings,'+');

    }	
}
