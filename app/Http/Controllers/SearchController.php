<?php

namespace App\Http\Controllers;

use Log;
use Request;
use Response;
use App\Product as Product;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Product as ProductTrait;

class SearchController extends Controller
{
    /**
     * Using the product trait here to exclude out 
     * the common logic required for both api and 
     * web
     */
    use ProductTrait;
    
    /**
     * Gives back the search results for a given product query
     * 
     * @return Illuminate\View
     */
    public function postSearch($query)
    {   
        // dd($query);
        $searchData = $this->queryProducts($query,5); 
        return $searchData;
        // return View('search.list-results',compact('searchData','query'));
    }  

    /**
	 * Gives back the search results for a given product query
	 * 
	 * @return Illuminate\View
	 */
    public function fullSearch($query)
    {   
        $searchData = Collection::make($this->queryProducts($query));
        $searchData = new \Illuminate\Pagination\LengthAwarePaginator($searchData,$searchData->count(),5);
        $searchData->setPath(route('home-page-search-full',$query));
        return View('home.view-all-search-results',compact('searchData','query'));
    }
}
