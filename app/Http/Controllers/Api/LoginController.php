<?php namespace App\Http\Controllers\Api;

use Auth;
use Request;
use Response;
use App\Order;
use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Http\Controllers\Api\Contracts\Login as LoginContract;

class LoginController extends ApiController implements LoginContract
{
    public function __construct()
    {
    }

    /**
     * Login the user 
     * @return json
     */
    public function login()
    {
        $input = Request::all();

        $validator = $this->validator($input);

        if ($validator->fails()) {
            return  $this->respond(['logged_in' => false, 'message' =>$validator->messages()]);
        }

        $userEmail = $input['user_email'];
        $userPassword = $input['user_password'];

        if (Auth::attempt(['email' => $userEmail, 'password' => $userPassword])) {
            $customer = Customer::where(['email' => $userEmail])->get();

            if (!$customer->isEmpty()) {
                $orderId = $this->getCustomerQoute($customer->first()->id);
                return $this->respond(['logged_in' => true, 'customer_id' => $customer->first()->id,
                        'customer_name' => $customer->first()->name,'api_key' => $customer->first()->api_key,
                        'order_id' =>$orderId, 'message' => 'Logged In Successfully']);
            }
            return  $this->respond(['logged_in' => false, 'message' => 'Unable to find the customer']);
        }

        return  $this->respond(['logged_in' => false, 'message' => 'Invalid user credentials provided']);
    }

    protected function getCustomerQoute($customerId)
    {
        $order = Order::where(['customer_id' => $customerId, 'order_status' => 0])->get();
        $orderId = null;

        if (!$order->isEmpty()) {
            $orderId =$order->first()->id;
        }
        return $orderId;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_email' => 'required|email',
            'user_password' => 'required',
            ]);
    }
}
