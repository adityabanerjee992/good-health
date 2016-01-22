<?php namespace App\Http\Controllers\Admin\Traits;

use Illuminate\Support\Facades\Validator;

trait BulkUpload{

    protected function saveFileToStorage($file,$fileType)
    {
		if($this->storeFile($file,$fileType)){
			return true;
		}
		return false;
    }

    protected function storeFile($file,$fileType)
    {
   		$fileName = $file->getClientOriginalName();

   		if($file->move(storage_path('/admin/imports/'.$fileType.'/'),$fileName)){
   			return true;
   		}
   		return false;
    }

    protected function validator($input,$key)
    {
      return Validator::make($input,[
      		$key => 'required|max:10000|mimes:csv,txt'
      	]);
    }
}