<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Register;

class RegisterCustomerController extends ApiController
{
	use Register;

	public function registerCustomer(Request $request)
	{
		$input = $request->all();

		$validator = $this->validator($input);

		if($validator->fails()){
			return  $this->respond(['is_registered' => 0, 'message' => $validator->messages()]);
		}

		$customer = $this->create($input);

		if($customer != NULL){
			return  $this->respond(['is_registered' => 1, 'message' => 'User Registered Successfully .. ','api_key' => $customer->api_key]);
		}
	}
}
