<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Contracts\Company as CompanyContract;

class CompanyController extends Controller implements CompanyContract
{

    /**
     * Get the company related to the product
     * 
     * @param  App\Product  $product 
     * @return string
     */
    public function getCompany($product)
    {
        $company=$product->companies()->get()->toArray();
        
        return $company[0]['company_name'];
    }   

}
