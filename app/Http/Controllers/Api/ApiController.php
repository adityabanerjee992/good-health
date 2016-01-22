<?php namespace App\Http\Controllers\Api;

use Response;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
	/**
	 * 
	 * @var int
	 */
	protected $statusCode = 200;

	/**
	 * 
	 * @return mixed
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * @param mixed $statusCode
	 * @return $this
	 */
	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;

		return $this;
	}

	/**
	 * 
	 * @param  string $message
	 * @return mixed
	 */
	public function respondNotFound($message = 'Not Found!')
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
	}

	/**
	 * 
	 * @param  string $message
	 * @return mixed
	 */
	public function respondInternalError($message = 'Internal Error!')
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
	}

	/**
	 * 
	 * @param  $data    
	 * @param  array  $headers
	 * @return mixed
	 */
	public function respond($data, $headers = [])
	{
		return Response::json($data, $this->getStatusCode(),$headers);
	}

	/**
	 * @param  string $message
	 * @return mixed
	 */
	public function respondWithError($message)
	{
		return $this->respond([
				'message' => $message,
				'status_code' => $this->getStatusCode()
		]);
	}
}
?>