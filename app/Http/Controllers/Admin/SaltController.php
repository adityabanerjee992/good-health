<?php namespace App\Http\Controllers\Admin;

use App\Salt;
use App\SaltCategory;
use App\ScheduleType;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\Contracts\Salt as SaltContract;
use App\Http\Controllers\Admin\Traits\BulkUpload as BulkUploadTrait;

class SaltController extends BaseController implements SaltContract
{
	use BulkUploadTrait;

	/**
	 * 
	 * @var SaltImporter
	 */
	protected $saltImporter;

	public function __construct(SaltImporter $saltImporter)
	{
		$this->setSaltImporter($saltImporter);
	}

    /**
     * Gets the value of saltImporter.
     *
     * @return mixed
     */
    public function getSaltImporter()
    {
        return $this->saltImporter;
    }

    /**
     * Sets the value of saltImporter.
     *
     * @param mixed $saltImporter the salt importer
     *
     * @return self
     */
    protected function setSaltImporter($saltImporter)
    {
        $this->saltImporter = $saltImporter;

        return $this;
    }

	/**
	 * Get all salts 
	 * 
	 * @return Illuminate\Contracts\View\View
	 */
	public function getAllSalts()
	{	
	    return view('admin.salt.index');
	}

    public function getSaltsAjax()
    {
        $salts = \App\Salt::all();
        
        return Datatables::of($salts)
        ->addColumn('actions','<a href="{{ route( \'salt-show\', $id) }}"> View </a>  &nbsp;
              <a href="{{ route( \'salt-edit\', $id) }}"> Edit </a>  &nbsp; 
              @if(\App\Salt::checkIfSaltExistInProduct($id) == false)
                <a href="{{ route(\'confirm-delete-salt\', $id) }}" data-toggle="modal" data-target="#delete_confirm">Delete</a>
              @endif')
        ->make(true);
    }

	/**
	 * Get the salt bulk upload form
	 * 
	 * @return Illuminate\Contracts\View\View
	 */
	public function getBulkUpload()
	{
		return view('admin.salt.bulk-upload');
	}

	/**
	 * Handles the form post request of bulk upload
	 * 
	 * @param  Request $request
	 * @return 
	 */
    public function postBulkUpload(Request $request)
    {
    	$input = $request->all();
 		$validator = $this->validator($input,'salt_file');
 		$file = $input['salt_file'];

 		if($validator->fails()){
			return Redirect::to(route('salt-bulk-upload'))
	            ->withErrors($validator);
 		}
 		
 		if($this->saveFileToStorage($file,'salts')){

 			$results = Excel::load($this->getFilePath($file), function($render){
 			})->all();

	 		if($results->count()>5000){
	 			Flash::error('File exceeds the maximum rows limit');
	 			return Redirect::to(route('salt-bulk-upload'));
	 		}

	 		if($results->count() == 0){
	 			Flash::error('Uploaded file is empty. That is it contains no data');
	 			return Redirect::to(route('salt-bulk-upload'));
	 		}

	 		return $this->getSaltImporter()->startImport($results);
 		}
 		else{
 			Flash::error('Unable to upload file to storage .. please try again !!');
 			return Redirect::to(route('salt-bulk-upload'));
 		}
    }

    /**
     * Provides the form to create a new salt
     * 
     * @return	Illuminate\Contracts\View\View  
     */
    public function getCreate()
    {
    	return view('admin.salt.create');	
    }

    /**
     * Handle the form post of new salt creation
     * 
     * @param  Request $request 
     * @return 
     */
    public function postCreate(Request $request)
    {
       $input = $request->all();
       $validator = $this->validatorSalt($input);
       
        if($validator->fails()){
            return Redirect::to(route('salt-create'))->withInput()
                ->withErrors($validator);
        }

        $input = (object) $input;

        if($this->getSaltImporter()->storeSalt($input)){
              Flash::success('Hooray !! . Salt Added SuccessFully ..');
                return Redirect::to(route('salt-create')); 
        }
        Flash::error('Unable to add the Salt. Please try again');
                return Redirect::to(route('salt-create')); 	
    }

   /**
    * Show the salt
    * 
    * @param  int $id 
    * @return Illuminate\Contracts\View\View 
    */
   	public function show($id)
	{
		$salt = Salt::find($id);
		$saltCategory = $salt->saltCategories;
		$saltScType = $salt->scheduleTypes;

		return view('admin.salt.show',compact('salt','saltCategory','saltScType'));
	}


    public function getEdit($id)
    {
    	return view('admin.index');
        $salt = Salt::find($id);
		$saltCategory = $salt->saltCategories;
		$saltScType = $salt->scheduleTypes;

        return view('admin.salt.edit',compact('salt','saltCategory','saltScType'));
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
              Flash::success('Hooray !! . Product Update SuccessFully ..');
                return Redirect::to(route('product-edit',$id)); 
        }
        Flash::error('Unable to update the product . Please try again');
                return Redirect::to(route('product-edit',$id)); 
    }
    
    /**
     * Get the file path to recently uploaded salts csv file
     * 
     * @param  string $file 
     * @return string 
     */
	protected function getFilePath($file)
    {
        return storage_path() .'/admin/imports/salts/'.$file->getClientOriginalName();
    }

    private function validatorSalt($input)
    {
      return Validator::make($input,[
            'salt_name' => 'required',
            'category' => 'required',
            'schedule' => 'required',
            'indications' => 'required',
            'dose' => 'required',
            'contraindications' => 'required',
            'precautions' => 'required',
            'adverse_effects' => 'required',
            'storage' => 'required'
        ]);
    }
}
