<?php namespace App\Http\Controllers;

use URL;
use App\Ailment;
use App\Classes;
use App\Salt as Salt;
use App\Http\Requests;
use App\Company as Company;
use App\Product as Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Manufacturer as Manufacturer;
use App\Http\Contracts\Product as ProductInterface;
use App\Http\Controllers\Traits\Product as ProductTrait;


class ProductController extends Controller implements ProductInterface
{
    use ProductTrait;
    
    /**
     * Get al products under a particular salt id
     * 
     * @param   integer     $id
     * @return  \Illuminate\view 
     */
    public function getProductsBySalt($id)
    {
        $salt = Salt::find($id);

        if(!is_null($salt))
        {

            $products=$this->prepareProductsDataBySalt($salt);

            $saltName= $salt->salt_name;

            $url=URL::current();

            return View('product.by-salt',compact('products','saltName','url'));
        }
        else
        {
            dd('No Products Under This Company');
        }
    }

    /**
     * Get all products under a particular company id
     * 
     * @param   integer     $id
     * @return  \Illuminate\view 
     */
    public function getProductsByCompany($id)
    {
        $company = Company::find($id);

        if(!is_null($company))
        {
            $products = $company->products()->paginate(2);

            $url=route('drugs-by-company');

            return View('product.by-companies',compact('products','url'));
        }
    }    

    /**
     * Get all products under a particular ailment id
     * 
     * @param   integer     $id
     * @return  \Illuminate\view 
     */
    public function getProductsByAilment($ailmentId)
    {
        $ailment = Ailment::find($ailmentId);

        if(!is_null($ailment))
        {
            $name = $ailment->ailment_name;
            $category = 'Ailments';
            $products = $ailment->products()->paginate(20);

            $url=route('products-by-ailment');

            return View('product.by-companies',compact('products','url','name','category'));
        }
    }

    /**
     * Get all products under a particular class id
     * 
     * @param   integer     $id
     * @return  \Illuminate\view 
     */
    public function getProductsByClass($classId)
    {
        $class = Classes::find($classId);

        if(!is_null($class))
        {
            $name = $class->class_name;
            $category = 'Class';
            $products = $class->products()->paginate(20);

            $url=route('products-by-class');

            return View('product.by-companies',compact('products','url','name','category'));
        }
    }

	/**
	 * Get all products under a particular manufacturer id
	 * 
	 * @param   integer 	$id
	 * @return  \Illuminate\view 
	 */
    public function getProductsByManufacturer($id)
    {
    	$manufacturer = Company::find($id);

    	if(!is_null($manufacturer))
    	{
            $products = $manufacturer->products()->paginate(20);
            $name = $manufacturer->company_name;
            $category = 'Manufacturer';
	    	$url=route('drugs-by-manufacturer');

	    	return View('product.by-companies',compact('products','url','category','name'));
    	}
    }

    /**
     * Get the product detailes by its Id
     * 
     * @param   integer 	$id
     * @return  \Illuminate\View
     */
    public function getProductDetailes($id)
    {
    	$product= Product::find($id);

    	$productDetails=NULL;
        $productsOnSameSalts=NULL;

        if(!is_null($product))
        {
            $productDetails      = $this->prepareProductDetailsArray($product);
            
	    	$productsOnSameSalts = $this->getProductsOnSameSalts($product);
            
            $productsOnSameSalts = new \Illuminate\Pagination\LengthAwarePaginator($productsOnSameSalts,count($productsOnSameSalts),1);
            $productsOnSameSalts->setPath(route('product-details',$id));
            $saltDetails         = $product->salts;
	    }

		return View('product.details',compact('productDetails',
											  'productsOnSameSalts','saltDetails'));
    }


    /**
     * Fetch the product detailes by its Id
     * 
     * @param   integer 	$id
     * @return  \Illuminate\View
     */
    public function fetchProductDetails($id)
    {
        $product= Product::find($id);
    	
        $productDetails=NULL;

    	if(!is_null($product))
    	{
	    	$productDetails = $this->prepareProductDetailsArray($product);
			
			return $productDetails;
	    }
    }

    /**
     * List all the products 
     * 
     * @return \Illuminate\View
     */
    public function listProducts()
    {
    	$products = Product::all();

    	return view('product.list',compact('products'));
    }
}
