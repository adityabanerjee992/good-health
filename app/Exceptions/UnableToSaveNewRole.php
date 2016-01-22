<?php namespace App\Exceptions;

use Flash;
use Redirect;

class UnableToSaveNewRole extends \Exception {

	/**
	 * Shows the error 
	 * 
	 * @return \Illuminate\Routing\Redirector
	 */
	public static function showError()
	{
        Flash::error('Unable to create the new role . .Please try again !!');
        return Redirect::route('role-create');        
	}
}