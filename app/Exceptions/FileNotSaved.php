<?php namespace App\Exceptions;

use Flash;
use Redirect;

class FileNotSaved extends \Exception {

	/**
	 * Shows the error 
	 * 
	 * @return \Illuminate\Routing\Redirector
	 */
	public static function showError()
	{
        Flash::error('Unable To Upload The File . Please Try Again.. ');
        return Redirect::route('upload-prescription');        
	}
}