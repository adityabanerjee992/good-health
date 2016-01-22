<?php namespace App\Http\Controllers;

use App\Pincode;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class PincodeController extends Controller
{
    public function checkPincode(Request $request)
    {
		$input = $request->all();

		if(isset($input['user_pincode']) and $input['user_pincode'] != NULL){
			$user_pincode = $input['user_pincode'];

			$pincode = Pincode::where('pincode',$user_pincode)->get();

			if($pincode->isEmpty()){
				return response(['location'=>'', 'message' => 'We Currently Dont Serve At This Location Or Pincode']);			
			}

			$stores = $pincode->first()->stores;

			if(!$stores->isEmpty()){
				 //set the cookie 
				  Cookie::queue('user_pincode', $user_pincode, 1440);
				 return response(['location'=>'', 'message' => 'Pincode Set Successfully ..']);
			}
			return response(['location'=>'', 'message' => 'We Currently Dont Serve At This Location']);
		}
    }
}
