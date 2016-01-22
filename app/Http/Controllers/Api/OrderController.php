<?php namespace App\Http\Controllers\Api;

use App\Order;
use App\Address;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends ApiController
{
	/**
	 * [linkAddressToOrder description]
	 * @return [type] [description]
	 */
    public function linkAddressToOrder()
    {
    	$input = Request::all();

        $rules = [ 
			  'customer_id'    => 'required|integer',
              'address_id'     => 'required|integer',
              'order_id'	   => 'required|integer'
             ];

        $validator = Validator::make($input,$rules);
    	
    	if($validator->fails()){
    		return $this->respondWithError($validator->messages());
    	}	
    	return $this->processlinkAddressToOrder($input);
    }	

    /**
     * [changeOrderStatusToConfirmed description]   
     * @return [type] [description]
     */
    public function changeOrderStatusToConfirmed()
    {
    	//order id , customer id
    	$input = Request::all();

        $rules = [ 
		  'customer_id'    => 'required|integer',
          'order_id'	   => 'required|integer'
         ];

        $validator = Validator::make($input,$rules);
    	
    	if($validator->fails()){
    		return $this->respondWithError($validator->messages());
    	}		
    	return $this->changeOrderStatus($input,1);
    }

    /**
     * [changeOrderStatus description]
     * @param  [type] $data   [description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    protected function changeOrderStatus($data,$status)
    {
        $order = Order::where(['id' => $data['order_id'], 'customer_id' => $data['customer_id']])->get()->first();
	    if ($order == NULL) {
         	return $this->respondNotFound('Order Not Found..');
        }

        if($this->orderIsEmpty($order)){
        	return $this->respondWithError('Order does not contain any items.. Order is empty');
        }

        $order->order_status = $status;
        if($order->save()){
        	return $this->respond(['message' => 'Order status changed successfully','order_status_change' => 1]);
        }
    }

    /**
     * [orderIsNotEmpty description]
     * @param  [type] $order [description]
     * @return [type]        [description]
     */
    protected function orderIsEmpty($order)
    {
    	$orderDetails = $order->orderDetails;

    	if($orderDetails->isEmpty()){
    		return TRUE;
    	}
    	return FALSE;
    }

    /**
     * [processlinkAddressToOrder description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    protected function processlinkAddressToOrder($data)
    {
   	    $address = Address::where(['id' => $data['address_id'], 'customer_id' => $data['customer_id']])->get()->first();
        if($address == NULL){
            return $this->respondNotFound('Address Not Found..');
         }

        $order = Order::where(['id' => $data['order_id'], 'customer_id' => $data['customer_id']])->get()->first();
        if ($order == NULL) {
         	return $this->respondNotFound('Order Not Found..');
         }

         $order->address_id = $data['address_id'];

         if($order->save()){
         	return $this->respond(['message' => 'Address Linked With Order Successfully', 'order_linked' => 1]);
         }
    }
}
