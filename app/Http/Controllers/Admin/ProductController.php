<?php namespace App\Http\Controllers\Admin;

use File;
use Validator;
use App\Classes;
use App\Product;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use yajra\Datatables\Facades\Datatables;
use App\Http\Controllers\Traits\Product as ProductTrait;
use App\Http\Controllers\Admin\Traits\BulkUpload as BulkUploadTrait;
use App\Http\Controllers\Admin\Contracts\Product as ProductInterface;

class ProductController extends Controller implements ProductInterface{
    
   use BulkUploadTrait;
   use ProductTrait;
   
	public function getAllProducts()
	{
	    return view('admin.product.index');
	}

    public function getProductsAjax()
    {
        $products = \App\Product::all();
        
        return Datatables::of($products)
        ->addColumn('actions','<a href="{{ route( \'product-show\', $id) }}"> View </a>  &nbsp;
              <a href="{{ route( \'product-edit\', $id) }}"> Edit </a>  &nbsp; 
              @if(\App\OrderDetails::checkIfProductExist($id) == false)
                <a href="{{ route(\'confirm-delete-product\', $id) }}" data-toggle="modal" data-target="#delete_confirm">Delete</a>
              @endif')
        ->make(true);
    }
    
    public function getCreate()
    {
        return view('admin.product.create');
    }
    
    public function postCreate(Request $request)
    {
       $input = $request->all();
       $validator = $this->validatorProduct($input);
       
        if($validator->fails()){
            return Redirect::to(route('product-create'))->withInput()
                ->withErrors($validator);
        }

        $input = (object) $input;
        if($this->storeProduct($input)){
              Flash::success('Hooray !! . Product Added SuccessFully ..');
                return Redirect::to(route('product-create')); 
        }
        Flash::error('Unable to add the product . Please try again');
                return Redirect::to(route('product-create')); 
    }

    public function getEdit($id)
    {
        $product = Product::find($id);
        $productData = $this->prepareProductDetailsArray($product);
        // dd($productData);
        return view('admin.product.edit',compact('productData'));
    }
	
    public function postEdit($id,Request $request)
    {
       $input = $request->all();
       $validator = $this->validatorProduct($input);
       if($validator->fails()){
            return Redirect::to(route('product-edit',$id))->withInput()
                ->withErrors($validator);
        }
        $input = (object) $input;
        if($this->updateProduct($input,$id)){
              Flash::success('Hooray !! . Product Updated SuccessFully ..');
                return Redirect::to(route('product-edit',$id)); 
        }
        Flash::error('Unable to update the product . Please try again');
                return Redirect::to(route('product-edit',$id)); 
    }
    
	public function show($id)
	{
		$product = Product::find($id);
		$productDetails = $this->prepareProductDetailsArray($product);
		return view('admin.product.show',compact('productDetails'));
	}

    public function getBulkUpload()
    {
    	return view('admin.product.bulk-upload');
    }

    /**
     * Responsbile for bulk upload of products ..
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postBulkUpload(Request $request)
    {
    	$input = $request->all();
 		$validator = $this->validator($input,'product_file');
 		$file = $input['product_file'];
 	
    	if($validator->fails()){
			return Redirect::to(route('bulk-upload'))
	            ->withErrors($validator);
 		}

 		if($this->saveFileToStorage($file,'products')){

 			$results = Excel::load($this->getFilePath($file), function($render){
 			})->all();

	 		if($results->count()>5000){
	 			Flash::error('File exceeds the maximum rows limit');
	 			return Redirect::to(route('bulk-upload'));
	 		}

	 		if($results->count() == 0){
	 			Flash::error('Uploaded file is empty. That is it contains no data');
	 			return Redirect::to(route('bulk-upload'));
	 		}

	 		return $this->startImport($results);
 		}
 		else{
 			Flash::error('Unable to upload file to storage .. please try again !!');
 			return Redirect::to(route('bulk-upload'));
 		}
    }
    
    protected function updateProduct($data,$id)
    {   
        $product = \App\Product::find($id);
        
        if(!is_null($product)){
            
            $product->product_code   = $data->sku;
            $product->product_name   = $data->product_name;
            $product->product_mrp    = $data->mrp;
            $product->product_tax    = $data->tax;
            $product->is_prescription_drug    = $data->prescription_drug;

            $product->save();

            return true;
        }   
        return false; 
    }

    protected function startImport($results)
    { 
        foreach ($results as $result) {
     
            $product = $this->createProduct($result);

            if(!is_null($product)){

                $this->createSalt($result,$product);

                if($result->ailment != ''){
                    $this->createAilment($result,$product);
                }

                if($result->class != ''){
                    $this->createClass($result,$product);
                }
                
                $this->createPacking($result,$product);
                $this->createUnit($result,$product);    
                $this->createCompany($result,$product);
                $this->createCategory($result,$product);
            }
            else{
                continue;
            }
        }
        Flash::success('Hooray !! .Products Imported SuccessFully .. ');
        return Redirect::to(route('bulk-upload'));
    }

   protected function storeProduct($result)
    {
		$product = $this->createProduct($result);

		if(!is_null($product)){
    		$this->createSalt($result,$product);
            $this->createAilment($result,$product);
            $this->createClass($result,$product);
    		$this->createPacking($result,$product);
    		$this->createUnit($result,$product);
    		$this->createCompany($result,$product);
    		$this->createCategory($result,$product);
	 	     return true;
        }
        return false;
    }

    private function validatorProduct($input)
    {
      return Validator::make($input,[
            'sku' => 'required',
            'product_name' => 'required',
            'mrp'  => 'required|numeric',
            'tax'  => 'required|numeric',
            'company'  => 'required',
            'category'  => 'required',
            'salt'  => 'required',
            'packing'  => 'required',
            'unit'  => 'required',
            'prescription_drug'  => 'required',
            'ailment'  => 'required',
            'class'  => 'required'  
        ]);
    }

    protected function createProduct($result)
    {
 		$product['product_code']             = $result->sku;
 		$product['product_name']             = $result->product_name;
        $product['product_mrp']              = $result->mrp;
        $product['product_tax']              = $result->tax;
        $product['is_prescription_drug']     = ($result->prescription_drug != '')? strtoupper($result->prescription_drug) : 'NO';

        if($this->productWithSameSkuExists($result->sku)){
            //get thet product 
            $product = \App\Product::where(['product_code' => $result->sku ])->get()->first();
            
            if($product != NULL){
                $product->product_name           = $result->product_name;
                $product->product_mrp            = $result->mrp;
                $product->product_tax            = $result->tax;
                $product->is_prescription_drug   = ($result->prescription_drug != '')? strtoupper($result->prescription_drug) : 'NO';
                
                if($product->save()){
                    //detach everything related to product .
                    $product->salts()->detach();
                    $product->ailments()->detach();
                    $product->classes()->detach();
                    $product->packings()->detach();
                    $product->units()->detach();
                    $product->companies()->detach();
                    $product->categories()->detach();

                    return $product;
                }
            }
            return NULL;
        }
 		return \App\Product::firstOrCreate($product);
    }
    protected function productWithSameSkuExists($sku)
    {
        $product = \App\Product::where(['product_code' => $sku])->get();

        if($product->isEmpty()){
           return false; 
        }
        else{
            return true;
        }
    }
    protected function createManufacturer($result,$product)
    {
  		$manufacturer['manufacturer_name'] = $result->company;
 		$manufacturerResult = \App\Manufacturer::firstOrCreate($manufacturer); 		
 		$product->manufacturers()->attach($manufacturerResult->id);
    }

    protected function createSalt($result,$product)
    {
 		$salts = explode('+',$result->salt);

 		foreach ($salts as $salt) {
            if($salt != NULL){
     			$data['salt_name'] = $salt;
                
                $saltWithSameNameExists = \App\Salt::where(['salt_name' => $salt])->get()->first();
                
                if($saltWithSameNameExists == NULL){
         			$create = \App\Salt::firstOrCreate($data); 
                    $product->salts()->attach($create->id);
                }
                else{
        	     	$product->salts()->attach($saltWithSameNameExists->id);
                }
            }
            else
            {
                continue;
            }
 		} 		
    }

    protected function createPacking($result,$product)
    {
 		$packings = explode('+',$result->packing);

 		foreach ($packings as $packing) {
 			$data['packing_type'] = $packing;
 			$create = \App\Packing::firstOrCreate($data); 
 			$product->packings()->attach($create->id);
 		} 		
    }   

    protected function createAilment($result,$product)
    {
        $ailments = explode('+',$result->ailment);

        foreach ($ailments as $ailment) {
            $data['ailment_name'] = $ailment;
            $create = \App\Ailment::firstOrCreate($data); 
            $product->ailments()->attach($create->id);
        }   

        return ;
    }
 
    protected function createClass($result,$product)
    {
        $classs = explode('+',$result->class);

        foreach ($classs as $class) {
            $data['class_name'] = $class;
            $create = \App\Classes::firstOrCreate($data); 
            $product->classes()->attach($create->id);
        }   

        return ;
    }
 
    protected function createUnit($result,$product)
    {
 		$units = explode('+',$result->unit);

 		foreach ($units as $unit) {
 			$data['unit_type'] = $unit;
 			$create = \App\Unit::firstOrCreate($data); 
 			$product->units()->attach($create->id);
 		} 		
    }   
    
    protected function createCompany($result,$product)
    {
 		$companies = explode('+',$result->company);

 		foreach ($companies as $company) {
 			$data['company_name'] = $company;
 			$create = \App\Company::firstOrCreate($data); 
 			$product->companies()->attach($create->id);
 		} 		
    }    

    protected function createCategory($result,$product)
    {
 		$categories = explode('+',$result->category);

 		foreach ($categories as $category) {
 			$data['category_name'] = $category;
 			$create = \App\Category::firstOrCreate($data); 
 			$product->categories()->attach($create->id);
 		} 		
    }

    protected function createType($result,$product)
    {
  		$type['type_name'] = ($result->prescription_drug == 'YES')? 'SCHEDULED' : 'OTC';
 		$typeResult = \App\Type::firstOrCreate($type); 		
 		$product->types()->attach($typeResult->id);
    }

    protected function attachAilment($result,$product)
    {
        $ailment['ailment_name'] = $result->ailment;

        $ailmentResult = \App\Ailment::firstOrCreate($ailment);     

        $product->ailments()->attach($ailmentResult->id);     
    }

    protected function attachClass($result,$product)
    {
        $class['class_name'] = $result->class;

        $classResult = \App\Classes::firstOrCreate($class);

        $product->classes()->attach($classResult->id);     
    }

    /**
     * Delete Confirm
     *
     * @param   int   $id
     * @return  View
     */
    public function getModalDelete($id = null)
    {
        $modalTitle = 'Delete Product';
        $modalBody = 'Are you sure you want to delete this product .. ? .Once deleted cannot be reverted back..';
        $error = NULL;

        $product = \App\Product::find($id);
        
        if($product != NULL){
            $confirm_route = route('delete-product',['id' => $product->id]);
            return view('admin/layouts/modal_confirmation_new', compact('modalTitle', 'modalBody', 'confirm_route','error','id'));
        }
        $error = 'Product Not Found';
        $confirm_route = route('delete-product',['id' => $product->id]);
        return view('admin/layouts/modal_confirmation_new', compact('modalTitle', 'modalBody', 'confirm_route','error'));
    }

    public function destroy($id)
    {
      $product = \App\Product::find($id);
      if($product->delete())
      {
         Flash::success('Hooray !! . Product Deleted SuccessFully ..');
                return Redirect::to(route('all-products')); 
      }
       Flash::error('Unable to delete the product .. Please try again .');
                return Redirect::to(route('all-products')); 
    }

    protected function getFilePath($file)
    {
        return storage_path() .'/admin/imports/products/'.$file->getClientOriginalName();
    }
}
