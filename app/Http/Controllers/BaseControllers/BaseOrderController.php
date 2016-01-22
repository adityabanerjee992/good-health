<?php namespace App\Http\Controllers\BaseControllers;

use Auth;
use Session;
use App\Http\Requests;
use App\Order as Order;
use Illuminate\Http\Request;
use App\OrderDetails as OrderDetails; 
use App\Http\Contracts\Order as OrderContract;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\Collection as Collection;

class BaseOrderController extends BaseController
{
	public function orderDetailsEmpty($order_id)
	{	
		// dd($order_id);
		
		$order = Order::find($order_id);
		
		$orderDetails = $order->orderDetails;

		if($orderDetails->isEmpty())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * [updateOrderUserId description]
	 * @param  [type] $token [description]
	 * @return [type]        [description]
	 */
    public function updateOrderUserId($token) 
	{
		$customer_id = Auth::user()->id;

		$update = Order::where(['token'=>$token])->update(['customer_id' => $customer_id]);

		if($update >= 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


  	/**
     * Get order id by User Id 
     * 
     * @param   interger  $customer_id
     *  
     * @return  integer   $order_id
     */
    public function getOrderId($customer_id)
	{
		if($customer_id!=NULL)
		{
			$order = Order::where(['customer_id'=> $customer_id,'order_status' => 0])->get();
			if($order->isEmpty()){
				return NULL;
			}
			return $order->first()->id;
		}
	}   

	public function getOrderDetails($id)
	{
		$order = Order::find($id);
		$orderDetails = $order->orderDetails;
		return $orderDetails;
	}	 

    /**
     * Get order details by uid
     * 
     * @param   interger  $uid
     * @param   string    $token
     *  
     * @return  Collection $orderDetails   
     */
	public function getOrderDetailsByUserIdAndUpdateToken($uid,$token)
	{
		if(!is_null($uid) and !is_null($uid))
		{
			$order = Order::where(['customer_id' => $uid , 'order_status' => 0])->get();

			if(!$order->isEmpty())
			{
				$orderObject = $order[0];

				$this->updateToken($order,$token);

				return $orderObject->orderDetails;
			}
			else
			{
				return Collection::make();
			}
		}
		else
		{
			return Collection::make();
		}
	}

    /**
     * Checks if order exists or not 
     * 
     * @param   int  $orderId
     * @return  boolean   
     */
    public function checkIfOrderExist($orderId)
    {
    	$order = Order::find($orderId);

    	if(!is_null($order))
    		return true;
    	else
    		return false;
    }


	public function getOrderIdByToken($token)
	{
		$order = Order::where(['token'=>$token])->get(['id']);

		if(!$order->isEmpty())
		{
			return $order[0]->id;
		}
	}

    /**
     * Check if order details exist
     * 
     * @param  int $order_id    
     * @param  string $product_code 
     * @return bool
     */
	public function checkIfOrderDetailsExist($order_id,$product_code)
	{
		$orderDetails = OrderDetails::where(['order_id'=>$order_id, 'product_code' => $product_code])->get();

		if(!$orderDetails->isEmpty())
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	/**
	 * This function checks for the previous quotes 
	 * if any exist for the same user id 
	 * 
	 * @param  	integer 	$customer_id
	 * @return \Illuminate\Database\Eloquent\Collection 	$order
	 */
	public function getOrderQuote($customer_id)
	{
		if($customer_id!=NULL)
		{
			$order = Order::where(['customer_id' => $customer_id, 'order_status' => 0])->get();

			if(!$order->isEmpty())
			{
				return $order;
			}
			return NULL;
		}
		return NULL;
	}

	/**
	 * Update the token in the orders table
	 * 
	 * @param  \Illuminate\Database\Eloquent\Collection  $order 
	 * @param  string 	$token 
	 * 
	 * @return boolean
	 */
	public function updateToken($order,$token)
	{
		if(!$order->isEmpty() and $token!=NULL)
		{
			// dd($order[0]->id);
			
			$orderId = $order[0]->id ;

			$update = Order::where('id',$orderId )->update(['token' => $token]);

			if($update >= 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return False;
		}
	}


    public function processCreateOrder($cartData,$token,$isApi = false,$customerId = NULL)
    {
 	   	$orderData = [];
 	   	$orderId = NULL;
 	   	$orderData['token']  = $token;
 	   	$orderData['order_status'] = 0;
 	   	$orderData['customer_id'] = ($isApi)? $customerId : Auth::user()->id;
 	   	// dd( Auth::user()->id);
		$order = $this->getOrderQuote($orderData['customer_id']);

   		if($order instanceof Collection) 
	 	{
	 		//update the token in the db 
	 		if($this->updateToken($order,$token))
	 		{
	 			$orderId=$order[0]->id;
	 		}	
		}
		else
		{	
		   	//save the order data 
	 	   	$order = Collection::make(Order::firstOrCreate($orderData));
	 	   	$orderId = $order['id'];
		}

   		if(!is_null($orderId))
   		{
			//lets put the order id in the session.
	        Session::put('order_id', $orderId);

	        if($this->saveOrderDetails($order,$orderId,$cartData))
	        {
	        	if($isApi){
        			return $orderId;
	        	}

	        	return true;
	        }
	        return false;   			
   		}
   		return false;
    }

    public function saveOrderDetails($order,$orderId,$cartData)
    {    	
 	   	if(!$order->isEmpty())
 	   	{
	 	   	$orderDetailsData=[];
	    		
	    	foreach ($cartData as $data) 
	    	{
	    		$orderDetailsData = $this->prepareOrderDetailsDataArray($orderId,$data);

    			if($this->checkIfOrderDetailsExist($orderDetailsData['order_id'],$orderDetailsData['product_code']))
		 	   	{
			 	   	//it means same product but quanity has been increased.
			 		$this->updateOrderQuanity($orderDetailsData['product_code'],$orderId,$orderDetailsData['quantity']);

			 	}
			 	else
			 	{
			 	   	OrderDetails::firstOrCreate($orderDetailsData);
			 	}
	    	}
	    	return true;
	    }
	    else
	    {
	    	return false;
	    }    	
    }

    public function prepareOrderDetailsDataArray($orderId,$data)
    {
		$orderDetailsData['order_id']= $orderId;
		$orderDetailsData['product_id']= $data->id;
		$orderDetailsData['product_code']= $data->options->product_code;
		$orderDetailsData['product_name']= $data->name;
		$orderDetailsData['quantity']= $data->qty;
		$orderDetailsData['price']= $data->price;

		return $orderDetailsData;
    }
}
