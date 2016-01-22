<?php namespace App\Http\Controllers\Api;

use Response;
use App\Product as Product;
use App\Http\Contracts\Salt as Salt;
use App\Http\Contracts\Unit as Unit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Http\Contracts\Company as Company;
use App\Http\Contracts\Packing as Packing;
use App\Http\Contracts\Category as Category;
use App\Http\Contracts\Manufacturer as Manufacturer;
use App\Http\Controllers\Traits\Product as ProductTrait;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Http\Controllers\Api\Contracts\Product as ProductContract;
use App\Acme\Transformers\ProductTransformer as ProductTransformer;
use App\Acme\Transformers\ProductDetailsTransformer as ProductDetailsTransformer;

class ProductController extends ApiController implements ProductContract
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
     * @param  string   $query
     * @return json
     */
    public function search($query,ProductTransformer $productTransformer)
    {
        $results = $this->queryProducts($query,50);

        if(empty($results))
        {
            $this->respondNotFound('No Products Found');
        }

        return $this->respond($productTransformer->tranformArray($results));
    }

    /**
     * Get all products
     * 
     * @return json
     */
    public function all(ProductTransformer $productTransformer)
    {
        $productsData = $this->allProducts();

        if(empty($productsData))
        {
            $this->respondNotFound('No Products Found');
        }

        return $this->respond($productTransformer->tranformArray($productsData));
    }

    /**
     * Get details of particular product
     * 
     * @param  
     * @return json
     */
    public function show(ProductDetailsTransformer $productDetailsTransformer)
    {
        $input = Request::all();

        if($input['product_id'] == NULL){
            $this->respond(['status' => 0 , 'message' => 'No Product id is provided']);
        }

        $product = Product::find($input['product_id']);

        if(is_null($product))
        {
            return $this->respondNotFound('Product Not Found');
        }

        $productDetailsData = $this->prepareProductDetailsArray($product);
        
        if(is_null($productDetailsData))
        {
            return $this->respondWithError('Unable to get the product details..');
        }

        return $this->respond($productDetailsTransformer->transform($productDetailsData));
    }
}

?>