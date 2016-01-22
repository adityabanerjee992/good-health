<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Contracts\Category as CategoryContract;

class CategoryController extends Controller implements CategoryContract
{
    /**
     * Get the categories related to the product
     * 
     * @param  App\Product  $product 
     * @return string
     */
    public function getCategories($product)
    {
        $categories=$product->categories()->get();

        $strCategories=null;

        foreach ($categories as $category) {
            
            $strCategories.= $category->category_name.'+';  
        }

        return trim($strCategories,'+');
    }    
}
