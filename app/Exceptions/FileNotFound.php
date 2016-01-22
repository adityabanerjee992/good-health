<?php namespace App\Exceptions;

class FileNotFound extends \Exception {

	/**
	 * Shows the error 
	 * 
	 * @return \Illuminate\Routing\Redirector
	 */
	public static function showError()
	{	
		$message = "Its looks like the file you are looking for is  not found in our system";
        return response()->view('errors.404',compact('message'));
	}
}