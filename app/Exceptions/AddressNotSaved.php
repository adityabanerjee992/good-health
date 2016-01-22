<?php namespace App\Exceptions;

use Flash;
use Redirect;

class AddressNotSaved extends \Exception {

	/**
	 * Shows the error 
	 * 
	 * @return \Illuminate\Routing\Redirector
	 */
	public static function showError()
	{
        Flash::error('Unable To Save New Address. Please Try Again Later .. ');
        return Redirect::route('my-address');        
	}
}