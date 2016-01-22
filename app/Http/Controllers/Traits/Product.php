<?php namespace App\Http\Controllers\Traits;

use App\Http\Contracts\Salt;
use App\Http\Contracts\Unit;
use Illuminate\Http\Request;
use App\Http\Contracts\Ailment;
use App\Http\Contracts\Company;
use App\Http\Contracts\Packing;
use App\Http\Contracts\Category;
use App\Product as ProductModel;
use Illuminate\Support\Collection;
use App\Http\Contracts\ProductType;
use Illuminate\Support\Facades\URL;
use App\Http\Contracts\Manufacturer;
use App\Http\Contracts\Classes as ProductClasses;

trait Product
{
    /**
     * 
     * @var App\Http\Contracts\Category
     */
    protected $category;

    /**
     * 
     * @var App\Http\Contracts\Salt
     */
    protected $salt;

    /**
     * 
     * @var App\Http\Contracts\Company
     */
    protected $company;

    /**
     * 
     * @var App\Http\Contracts\Packing
     */
    protected $packing;

    /**
     * 
     * @var App\Http\Contracts\Unit
     */
    protected $unit;

    /**
     * 
     * @var App\Http\Contracts\Manufacturer
     */
    protected $manufacturer;

    /**
     * 
     * @var App\Http\Contracts\Ailment
     */
    protected $ailment;   

    /**
     * 
     * @var App\Http\Contracts\Classes
     */
    protected $classes;   

    /**
     * 
     * @var App\Http\Contracts\ProductType
     */
    protected $productType;

    
   public function __construct(Category $category,Salt $salt,Company $company,
                               Packing $packing,Unit $unit,Manufacturer $manufacturer,
                               Ailment $ailment,ProductClasses $classes,ProductType $productType)
    {
        $this->category         = $category;
        $this->salt             = $salt;
        $this->company          = $company;
        $this->packing          = $packing;
        $this->unit             = $unit;
        $this->manufacturer     = $manufacturer;
        $this->ailment          = $ailment;
        $this->classes          = $classes;
        $this->productType      = $productType;
    }

    /**
     * Prepare Porduct Data For Given Product Collection
     * 
     * @param  App\Product 	$products 
     * @return array
     */
    private function prepareProductsData($products)
    {
    	$arrayIndex=0;

    	foreach ($products as $product) {

            $searchData[$arrayIndex]['id']             = $product->id;
    		$searchData[$arrayIndex]['product_name']   = $product->product_name;
    		$searchData[$arrayIndex]['salts'] 		   = $this->salt->getSalts($product);
    		$searchData[$arrayIndex]['categories']     = $this->category->getCategories($product);
    		$searchData[$arrayIndex]['packing']        = $this->packing->getPacking($product);
    		$searchData[$arrayIndex]['unit'] 		   = $this->unit->getUnit($product);
    		$searchData[$arrayIndex]['company']  	   = $this->company->getCompany($product);
            // $searchData[$arrayIndex]['manufacturer']   = $this->manufacturer->getManufacturer($product);
    		$searchData[$arrayIndex]['ailments']       = $this->ailment->getAilments($product);
    		$searchData[$arrayIndex]['product_code']   = $product->product_code;
    		$searchData[$arrayIndex]['product_mrp']    = $product->product_mrp;
            $searchData[$arrayIndex]['product_tax']    = $product->product_tax;
    		$searchData[$arrayIndex]['product_details_link']  = URL::to('/').'/products/details/'.$product->id;
    		
    		$arrayIndex++;
    	}

    	return $searchData;
    }

    /**
     * Get products based on a query
     * @param  string $query
     * @return array  $searchData
     */
    private function queryProducts($query,$limit = NULL)
    {
        if($limit != NULL){
            $products = ProductModel::where('product_name','LIKE','%'.$query.'%')->take($limit)->get();
        }
        else{
            $products = ProductModel::where('product_name','LIKE','%'.$query.'%')->get();
        }

        if(!$products->isEmpty())
        {
            $searchData = $this->prepareProductsData($products);
        }
        else
        {
            $searchData=[];
        }
        
        // Log::info('SearchController >> Returning Search Results For Query  '. "$query"); 
        return $searchData;
    }  

   /**
     * Get all products
     * 
     * @return array  $productsData
     */
    private function allProducts()
    {   
        //all is bad . Need to apply pagination here
        $products = ProductModel::all();
        
        if(!$products->isEmpty())
        {
            $productsData = $this->prepareProductsData($products);
        }
        else
        {
            $productsData=[];
        }
        return $productsData;
    }

    
    /**
     * Get all the products which are made of same salts
     * 
     * @param  object   $product
     * @return array    $productsOnSameSalts
     */
    private function getProductsOnSameSalts($product)
    {
        $productsOnSameSalts=[];

        $salts= $product->salts;

        foreach ($salts as $salt) {

            $products= $salt->products;
            // dd($products);

            foreach ($products as $product) {

                $productsOnSameSalts[$product['id']] = $this->prepareProductDetailsArray($product);

            }

        }

        return $productsOnSameSalts;
    }   

    /**
     * Prepare the product details array for the given product 
     * 
     * @param   object  $product 
     * @return  array   $productDetailsArray
     */
    private function prepareProductDetailsArray($product)
    {
        $productDetailsArray = [];

        // $productDetailsArray['id']           = $product->id;
        // $productDetailsArray['code']         = $product->product_code;
        // $productDetailsArray['name']         = $product->product_name;
        // $productDetailsArray['manufacturer'] = $this->getManufacturer($product);
        // $productDetailsArray['salt']         = $this->getSalt($product);
        // $productDetailsArray['unit']         = $this->getUnit($product);
        // $productDetailsArray['packing']      = $this->getPacking($product);
        // $productDetailsArray['product_type'] = $this->getType($product);
        // $productDetailsArray['mrp']          = $product->product_mrp;
        // $productDetailsArray['less_mrp']     = $product->product_rate_a;
                
            $productDetailsArray['id']             = $product->id;
            $productDetailsArray['product_name']   = $product->product_name;
            $productDetailsArray['salts']          = $this->salt->getSalts($product);
            $productDetailsArray['categories']     = $this->category->getCategories($product);
            $productDetailsArray['packing']        = $this->packing->getPacking($product);
            $productDetailsArray['unit']           = $this->unit->getUnit($product);
            $productDetailsArray['company']        = $this->company->getCompany($product);
            // $productDetailsArray['manufacturer']   = $this->manufacturer->getManufacturer($product);
            $productDetailsArray['ailments']       = $this->ailment->getAilments($product);
            $productDetailsArray['classes']        = $this->classes->getClasses($product);
            // $productDetailsArray['product_type']   = $this->productType->getProductType($product);
            $productDetailsArray['product_code']   = $product->product_code;
            $productDetailsArray['product_mrp']    = $product->product_mrp;
            $productDetailsArray['is_prescription_drug']    = $product->is_prescription_drug;
            $productDetailsArray['product_tax']    = $product->product_tax;

        return $productDetailsArray;
    }

    /**
     * Get the manufacture name for the given product
     * 
     * @param   object  $product 
     * @return  string  $manuFacturerName
     */
    private function getManufacturer($product)
    {       
        $manufacturers= $product->manufacturers;

        if(!$manufacturers->isEmpty())
        {
            $manufacturerName=NULL;

            foreach ($manufacturers as $manufacturer) {

                $manufacturerName .= $manufacturer->manufacturer_name. '+';
            }
            return trim($manufacturerName,'+');
        }
        else
        {
            return NULL;
        }
    }

    /**
     * Get the salt name for the given product
     * 
     * @param  object   $product 
     * @return string   $saltName
     */
    private function getSalt($product)
    {       
        $salts= $product->salts;

        if(!$salts->isEmpty())
        {
            $saltName=NULL;

            foreach ($salts as $salt) {

                $saltName .= $salt->salt_name . "+";
            }

            return trim($saltName,'+');
        }
        else
        {
            return NULL;
        }
    }    

    /**
     * Get the unit name for the given product
     * 
     * @param   object  $product 
     * @return  string  $unitName
     */
    private function getUnit($product)
    {       
        $units= $product->units;

        if(!$units->isEmpty())
        {
            $unitName=NULL;

            foreach ($units as $unit) {

                $unitName .= $unit->unit_type . "+";
            }

            return trim($unitName,"+");

        }
        else
        {
            return NULL;
        }
    } 

    /**
     * Get the packing name for the given product
     * 
     * @param   object  $product 
     * @return  string  $packingName
     */
    private function getPacking($product)
    {       
        $packings= $product->packings;

        if(!$packings->isEmpty())
        {
            $packingName=NULL;

            foreach ($packings as $packing) {

                $packingName .= $packing->packing_type . "+";
            }

            return trim($packingName,"+");

        }
        else
        {
            return NULL;
        }
    }

    /**
     * Get the product type for the given product
     * 
     * @param   object  $product 
     * @return  string  $packingName
     */
    private function getType($product)
    {       
        $productTypes = $product->types;

        if(!$productTypes->isEmpty())
        {
            $typeName=NULL;

            foreach ($productTypes as $productType) {

                $typeName .= $productType->type_name . "+";
            }

            return trim($typeName,"+");

        }
        else
        {
            return NULL;
        }
    }

    /**
     * Prepares the product data by the given salt object
     * 
     * @param   object  $salt [description]
     * @return  array
     */
    private function prepareProductsDataBySalt($salt)
    {
        $products=$salt->products;

        $productsDataBySalt=NULL;

        foreach ($products as $product) {

            $productsDataBySalt[]= $this->prepareProductDetailsArray($product);

        }

        return Collection::make($productsDataBySalt);
    }
}



