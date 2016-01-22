<?php namespace App\Http\Controllers\Api\Contracts;

interface UserAccount{

	/**
	 * Get user documents .. 
	 * 
	 * @return json
	 */
	public function userDocuments();

	/**
	 * Get user address
	 * @return json
	 */
    public function userAddress();
}