<?php namespace App\Http\Controllers\Admin\Contracts;


Interface Salt {

	/**
	 * Get all salts 
	 * 
	 * @return Illuminate\Contracts\View\View
	 */
	public function getAllSalts();

	/**
	 * Get the salt bulk upload form
	 * 
	 * @return Illuminate\Contracts\View\View
	 */
	public function getBulkUpload();


	/**
	 * Handles the form post request of bulk upload
	 * 
	 * @param  Request $request
	 * @return 
	 */
    public function postBulkUpload(\Request $request);

}