<?php namespace App\Http\Controllers\Api\Contracts;

interface Login
{
	/**
	 * Login the user 
	 * @return json
	 */
	public function login();
}
