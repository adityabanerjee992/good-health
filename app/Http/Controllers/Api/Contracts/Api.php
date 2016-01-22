<?php

namespace App\Http\Controllers\Api\Contracts;

interface Api
{
	/**
	 * 
	 * @param  string $message
	 * @return mixed
	 */
	public function respondNotFound($message);

	/**
	 * 
	 * @param  string $message
	 * @return mixed
	 */
	public function respondInternalError($message);

	/**
	 * 
	 * @param  $data    
	 * @param  array  $headers
	 * @return mixed
	 */
	public function respond($data, $headers);


	/**
	 * @param  string $message
	 * @return mixed
	 */
	public function respondWithError($message);
}