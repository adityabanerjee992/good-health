<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Contracts\ProductType as ProductTypeContract;

class ProductTypeController extends Controller implements ProductTypeContract
{
     /**
     * Get the product type
     * 
     * @param  App/Product  $product
     * @return string
     */
    public function getProductType($product)
    {
        $productTypes = $product->types;

        $strProductType=null;

        foreach ($productTypes as $productType) {
            
            $strProductType.= $productType->type_name.'+';   
        }
        return trim($strProductType,'+');
    }   
}
