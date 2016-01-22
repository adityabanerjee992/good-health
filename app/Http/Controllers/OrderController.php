<?php namespace App\Http\Controllers;

use Auth;
use Session;
use App\Http\Requests;
use App\Order as Order;
use Illuminate\Http\Request;
use App\OrderDetails as OrderDetails; 
use App\Http\Contracts\Order as OrderContract;
use Illuminate\Database\Eloquent\Collection as Collection;
use App\Http\Controllers\BaseControllers\BaseOrderController as BaseOrderController;

class OrderController extends BaseOrderController implements OrderContract
{
	/**
     * Add order to orders table
     * 
     * @param   Illuminate\Support\Collection  $cartData 
     * @param   string  $token
     * @param   bool    $isApi
     * 
     * @return  boolean
     */
    public function createOrder($cartData,$token,$isApi = false,$customerId = NULL)
    {
    	if($isApi){
 	   		return $this->processCreateOrder($cartData,$token,$isApi,$customerId);
    	}
    	else{
	 	   	if(Auth::check()!=False)
	 	   	{
	 	   		return $this->processCreateOrder($cartData,$token,$isApi);
		    }
		    else
		    {
		    	return false;
		    }
		}
    }

    /**
	 * [updateOrderQuanity description]
	 * @param  [type] $product_code [description]
	 * @param  [type] $quantity     [description]
	 * @return [type]               [description]
	 */
	public function updateOrderQuanity($product_code,$order_id=NULL,$quantity,$token=NULL)
	{		
		if($order_id==NULL)
		{
			//fetch the order id by token			
			$order_id = $this->getOrderIdByToken($token);
		}	
			$orderDetails = OrderDetails::where(['order_id'=>$order_id, 'product_code' => $product_code])->get();
			if(!$orderDetails->isEmpty())
			{
				$orderDetailsId = $orderDetails[0]->id;	

				$orderDetail = OrderDetails::find($orderDetailsId);

				$orderDetail->quantity = $quantity;

				$result = $orderDetail->save();

				if($result)
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
				return false;
			}
	}

	public function deleteOrderDetails($product_code,$order_id=NULL,$quantity,$token=NULL)
	{
		if($order_id==NULL)
		{
			//fetch the order id by token			
			$order_id = $this->getOrderIdByToken($token);
			
			$orderDetails = OrderDetails::where(['order_id'=>$order_id, 'product_code' => $product_code])->delete();
			
			$this->deleteOrder($order_id);

			return true;
		}	
		else
		{
			$orderDetails = OrderDetails::where(['order_id'=>$order_id, 'product_code' => $product_code])->delete();	

			$this->deleteOrder($order_id);
			
			return true;
		}
	}

	public function deleteOrder($order_id)
	{
		$result = $this->orderDetailsEmpty($order_id);

		if($result)
		{
			$order = Order::find($order_id);

			$order->delete();
		}
	}

	public function udpateOrderData($orderId,$orderData)
	{
		if(!is_null($orderId) and !is_null($orderData))
		{
			$order = Order::find($orderId);

			if(!is_null($order))
			{	
				foreach ($orderData as $key => $value) {
					$order->$key = $value;
				}
				
				$order->save();
				return true;
			}
			else
			{
				//log the info here using laravel logger.
				return false;
			}
		}
		else
		{
			//log the error here .. 
			return false;
		}
	}	
}
