<?php namespace App\Http\Controllers\Admin\Traits;

use App\Order;
use App\Store;
use App\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

trait Logistics{

	protected $apiKey;
    protected $baseApiUrl;
	protected $orderObject;

    /**
     * Add a new order to the Logistic Service ..
     * 
     * @param  int $orderId
     * @return bool
     */
	public function addOrderToFarEye($orderId)
	{
		$this->setApiVariables();
        $this->setOrderObject($orderId);

        $order = $this->getOrderObject();

        if($order->logistic_reference_no != NULL){
            // it means we need to run the update operation..
            return $this->updateOrderToFarEye('Delivery',$orderId); 
        }

		return $this->sendRequest('job',$orderId);
	}

    /**
     * Update the order to the Logistic Service ..
     * 
     * @param  string $jobType 
     * @param  int    $orderId 
     * @return bool
     */
	public function updateOrderToFarEye($jobType,$orderId)
	{
        return $this->sendRequest('job/update',$orderId);
	}

    /**
     * Send the request to the Logistic Service 
     * 
     * @param  string $uri   
     * @param  int    $orderId 
     * @return bool
     */
    protected function sendRequest($uri,$orderId)
    {
        $client = new \Guzzle\Service\Client($this->getBaseApiUrl());
        $postBody = $this->getPostBody('Delivery',$orderId);

        $postBody = json_encode($postBody);

        try{
            $response = $client->post($uri.'?api_key='.$this->getApiKey(),null,$postBody,['exceptions' => FALSE])->send();
        }
        catch (\GuzzleHttp\Exception\ConnectException $e) {
            $statusCode = $e->getstatusCodeuest();  
            $errorMessage =$e->getResponse();
            
            Log::info('Tried to hit the logistice service but code : status code : '. 
                        $statusCode . ' Detailed Error : '. $errorMessage);
            return false;
            
        }      
        catch (\GuzzleHttp\Exception\RequestException $e) {
            $statusCode = $e->getstatusCodeuest();
            $errorMessage = $e->getResponse();
            
            Log::info('Tried to hit the logistice service but code : status code : '. 
                        $statusCode . ' Detailed Error : '. $errorMessage);
            return false;
            
        }        
        catch (\GuzzleHttp\Exception\ClientException $e) {
            $statusCode = $e->getstatusCodeuest();
            $errorMessage =$e->getResponse();
            
            Log::info('Tried to hit the logistice service but code : status code : '. 
                        $statusCode . ' Detailed Error : '. $errorMessage);
            return false;

        }        
        catch (\GuzzleHttp\Exception\ServerException $e) {
            $statusCode = $e->getstatusCodeuest();
            $errorMessage =$e->getResponse();
            
            Log::info('Tried to hit the logistice service but code : status code : '. 
                        $statusCode . ' Detailed Error : '. $errorMessage);
            return false;

        }        
        catch (\GuzzleHttp\Exception\TooManyRedirectsException $e) {
            $statusCode = $e->getstatusCodeuest();
            $errorMessage =$e->getResponse();
            
            Log::info('Tried to hit the logistice service but code : status code : '. 
                        $statusCode . ' Detailed Error : '. $errorMessage);
            return false;

        }

        if($response->getStatusCode() == 200){
           $body = json_decode($response->getBody());

            if($body->successCount = 1){
                return true;
            }
        }
        Log::info('Unable to call fareye ..');
        return false;
    }

    /**
     * Sets the api variables
     */
    protected function setApiVariables()
    {
		$this->setApiKey(Config::get('logistics.api_key'));
		$this->setBaseApiUrl('https://staging.fareye.co/api/v1/');
    }

    /**
     * Get the post body which needs to be sent 
     * with the request
     *  
     * @param  string $jobType 
     * @param  int    $orderId 
     * @return bool
     */
    protected function getPostBody($jobType,$orderId)
    {
        return [ [
                        "jobType"=> $jobType,
                        "referenceNo"=> $this->generateAndGetRefrenceNumberForOrder($orderId),
                        "date"=> date('Y-m-d'),
                        "city"=> $this->getCity($orderId),
                        "hub"=>  $this->getHub($orderId),    
                        // "latitude"=> "28.1546  /*optional*/",    
                        // "longitude"=> "77.2657 /*optional*/",
                        "slot"=> "3",
                        "jobData"=> $this->getjobData($orderId)
                   ]    
                ];
    }

    /**
     * Get or Prepare the job data that needs to be 
     * send with the request 
     * 
     * @param  int $orderId 
     * @return array
     */
    protected function getjobData($orderId)
    {
        $order = $this->getOrderObject();

        $customer = Customer::find($order->customer_id);

        $shippingAddress = json_decode($order->shipping_address);

        return [ 
                    "customer_name"=> $customer->name,
                    "contact_number"=> $customer->phone,
                    "address"=> $shippingAddress->address . ', ' . 
                                $shippingAddress->city . ', ' .  
                                $shippingAddress->state . ', ' .  
                                $shippingAddress->pincode . ', India',

                    "amount_to_be_collected"=> $order->order_total,

                    "information"=> $this->getOrderDetails($orderId)
            ];
    }

    /**
     * Get the order details by order id .
     * 
     * @param  int $orderId 
     * @return array
     */
    protected function getOrderDetails($orderId)
    {
        $order = $this->getOrderObject();
        
        $information = [];

        if($order != NULL){
            $orderDetails = $order->orderDetails;
            $index = 0;

            if(!$orderDetails->isEmpty()){
                foreach ($orderDetails as $orderDetail) {
                    // dd($orderDetail);
                    $information[$index]['quantity'] = $orderDetail->quantity;
                    $information[$index]['unit_price'] = $orderDetail->price;
                    $information[$index]['item_description'] = $orderDetail->product_name;
                    $information[$index]['sku_code'] = $orderDetail->product_code;
                    
                    $index ++;
                }
            }
        }
        return $information;    
    }

    /**
     * Generate the reference number and save it with 
     * the order .
     * 
     * @param  int $orderId 
     * @return string
     */
    protected function generateAndGetRefrenceNumberForOrder($orderId)
    {
        $order = $this->getOrderObject();

        if($order != NULL){
            $refNo = 'FAR'.$orderId;
            $order->logistic_reference_no = $refNo;

            if($order->save()){
                return $refNo;
            }
        }
        return NULL;
    }   

    /**
     * Get the city 
     * 
     * @param  int $orderId 
     * @return string
     */
    protected function getCity($orderId)
    {
        $order = Order::find($orderId);

        if($order != NULL){
           $storeId = $order->store_id;
           $store = Store::find($storeId);

           if($store != NULL){
                return $store->city;
           }
        }
        return NULL;
    }   

    /**
     * Get the hub .
     * 
     * @param  int $orderId 
     * @return string
     */
    protected function getHub($orderId)
    {
        $order = Order::find($orderId);

        if($order != NULL){
           $storeId = $order->store_id;
           $store = Store::find($storeId);

           if($store != NULL){
                return $store->hub;
           }
        }
        return NULL;
    }

    /**
     * Gets the value of order.
     *
     * @return mixed
     */
    public function getOrderObject()
    {
        return $this->orderObject;
    }

    /**
     * Sets the value of order.
     *
     * @param mixed $order the order
     *                     
     * @return self
     */
    protected function setOrderObject($orderId)
    {
        $this->orderObject = Order::find($orderId);
        return $this;
    }

    //Getter And Setters ..
        /**
     * Gets the value of apiKey.
     *
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Sets the value of apiKey.
     *
     * @param mixed $apiKey the api key
     *
     * @return self
     */
    protected function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Gets the value of baseApiUrl.
     *
     * @return mixed
     */
    public function getBaseApiUrl()
    {
        return $this->baseApiUrl;
    }

    /**
     * Sets the value of baseApiUrl.
     *
     * @param mixed $baseApiUrl the base api url
     *
     * @return self
     */
    protected function setBaseApiUrl($baseApiUrl)
    {
        $this->baseApiUrl = $baseApiUrl;

        return $this;
    }

}

