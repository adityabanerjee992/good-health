<?php namespace App\Http\Controllers\Traits;

use URL;
use Auth;
use Flash;
use Input;
use Cookie;
use Request;
use Session;
use Redirect;
use Response;
use Validator;
use App\Http\Requests;
use Cart as ShoppingCart;
use App\Address as Address;
use App\Customer as Customer;
use Illuminate\Support\Collection;
use App\PaymentType as PaymentType;
use App\Http\Contracts\Order as Order;
use App\Http\Contracts\Product as Product;
use App\Http\Contracts\DocumentUpload as DocumentUpload;

trait Cart
{
    /**
     * Order object used for communicating 
     * with the order interface or 
     * contract
     * 
     * @var \App\Http\Contracts\Order
     */
    protected $order;

    /**
     *    
     * Product object used for communicating 
     * with the product interface or 
     * contract
     * 
     * @var \App\Http\Contracts\Product
     */
    protected $product;

    /**
     * documentUpload object for storing the 
     * document
     * 
     * @var \App\Http\Contracts\documentUpload
     */
    protected $documentUpload;

    /**
     * Address  object for storing the 
     * address
     * 
     * @var \App\Http\Contracts\Address
     */
    protected $address;

    public function __construct(Order $order, Product $product,documentUpload $documentUpload,Address $address)
    {
        $this->order = $order;

        $this->product = $product;

        $this->documentUpload = $documentUpload;

        $this->address = $address;
    }


    public function getUploadPrescription()
    {
        if(Auth::Check())
        {            
            $drugsName = $this->getScheduledDrugsFromCart();

            if($drugsName != NULL)
            {
                return View('cart.upload-prescription',compact('drugsName'));       
            }
            else
            {
                return redirect('/cart/address');
            }
        }
        else
        {
            return redirect('auth/login');
        }
    }  

    public function postUploadPrescription()
    {
        if(Auth::Check())
        {
            if (Input::hasFile('prescription_file')) 
            {
                $file = Input::file('prescription_file');

                $orderId= $this->order->getOrderId(Auth::User()->id);
                $dest = base_path().'/storage/app/customer/'.Auth::user()->id.'/prescriptions';
                $dest1 ='/customer/'.Auth::user()->id.'/prescriptions/';
                $documentType = "prescription";

                if($this->documentUpload->store($file,$orderId,$dest1,$documentType))
                {
                    return redirect('cart/address');
                }  
                else
                {
                    dd('Unable to upload prescription');
                }
            }
        }
    }  

    public function address()
    {
        $addressData = Address::where(['customer_id' => Auth::user()->id])->get();
        
        return View('cart.address',compact('addressData'));     
    } 

    public function orderSummary()
    {
        $orderId = Session::get('order_id');

        $orderDetails = $this->order->getOrderDetails($orderId);

        $paymentTypes = PaymentType::all();

        return View('cart.order-summary',compact('orderDetails','paymentTypes'));      
    }
    
    public function orderConfirmation()
    {
        $input = Request::all();

        $validator =$this->validator($input);

        if($validator->fails()) {
            Flash::error('Please choose your payment method ..');
            return Redirect::route('order-summary');
        }

        //change the order status to confirmed . 
        $orderStatus = 1;
        
        /**
         * This is temporary here . When the address selection
         * logic gets ready than we need to insert the actual 
         * choosen address id .. 
         */
        $user = Customer::find(Auth::user()->id);
        $userAddresses = $user->addresses;
        //Temp block ends here 

        $orderId = Session::get('order_id');
        $addressId = $userAddresses->first()->id;

        if(!is_null($orderId))  
        {
            $cookie = Cookie::get('gh_token');

            $cartTotal = ShoppingCart::instance($cookie)->total();

            /**
             *  Important : Temporary
             *  
             * This logic is temporary here to calculate the 
             * cart total . When the dicounts rules are 
             * defined and payment calculation procedure gets to be
             * defined than this needs to be changed..
             */
            $cartTotal = (($cartTotal/100)*75)+ (($cartTotal/100)*12);

            $orderData = [
            'order_status' => $orderStatus , 
            'address_id'   => $addressId,
            'order_total'  => $cartTotal,
            'payment_type_id' => $input['payment_type']
            ];

            if($this->order->udpateOrderData($orderId,$orderData))
            {
                //destroy the cart 

                //destroy the sesson variables 

                Session::forget('order_id');

                ShoppingCart::instance($cookie)->destroy();

                //destroy the cookie 
                $cookie = Cookie::forget('gh_token');

                return Response::make(View('cart.order-confirmation'))->withCookie($cookie);

            }
            else
            {
                dd('Unable to process the order . please try again later on ... Sorry for the trouble .. ');
            }
        }
        else
        {
            return redirect(url(''));
        }

    }

    public function checkout()
    {
        if(Auth::check())
        {
            if(Request::hasCookie('gh_token'))
            {
                //update the user id in the orders table

                //redirect to upload prescription page.. 

                $token = Cookie::get('gh_token');

                $cartData = ShoppingCart::instance($token)->content();

                if($cartData->isEmpty()){

                    return $this->getShowResponse($cartData);
                }

                if($this->addProductInCartToDb($cartData,$token))
                {
                    return redirect('cart/upload-prescription');
                }
                else
                {
                    dd('Some Error Occured Please Try Again Later .. !!');
                }
            }
            else
            {
                return redirect(url(''));
            }

        }
        else
        {
           return redirect(url('/auth/login'));
       }
   }

   public function addProductToCart($id,$customerId = NULL,$isApi = false,$quantity = 1)
   {   
    $productData= [];

    $productData = $this->product->fetchProductDetails($id);
    
    if(Request::hasCookie('gh_token'))
    {
        $cookie = Cookie::get('gh_token');
    }
    else
    {
        $cookie = $this->setCookie();
    }
        // ShoppingCart::instance($cookie)->destroy();

    if(!empty($productData))
    {   
        if($productData['is_prescription_drug'] == 'YES')
        {
            $prescription= 'Yes';
        }
        else
        {
            $prescription = 'No';
        }

        $options=['product_code' => $productData['product_code'],
        'prescription' => $prescription,
        'company' => $productData['company'],
        'salt'         => $productData['salts'],
        'unit'         => $productData['unit'],
        'packing'      => $productData['packing']
        ];

        ShoppingCart::instance($cookie)->add($productData['id'],$productData['product_name'],$quantity,$productData['product_mrp'],$options);

        $cartData = ShoppingCart::instance($cookie)->content();

        if($isApi)
        {
            return $this->addProductInCartToDb($cartData,$cookie,$isApi,$customerId); 
        }

        if(!$cartData->isEmpty() and $cookie != NULL and Auth::check() == TRUE)
        {
            return $this->addProductInCartToDb($cartData,$cookie); 
        }

        $itemsCount= ShoppingCart::instance($cookie)->count();

        $cartTotal = ShoppingCart::instance($cookie)->total();

        return view('cart.show',compact('cartData','itemsCount','cartTotal'));
    }
    else
    {
        dd('No Product Found');
            //re direct to home page..
    }

}

   /**
    * Reorder the order with the given
    * order id 
    * @param  int $orderId 
    * @return 
    */
   public function cartReorder()
   {   
    $input = Request::all();
    $orderId = $input['order_id'];

    if($this->order->checkIfOrderExist($orderId))
    {
        $orderDetails = $this->order->getOrderDetails($orderId);

        if(is_null($orderDetails))
        {
            Flash::error('Unable to reorder your order ..');
            return Redirect::route('my-orders');
        }
        else
        {
            return $this->addProductToCartInBulk($orderDetails);
        }
    }
    else
    {
        return redirect(route('home'));
    }
}

private function addProductToCartInBulk($orderDetails)
{
    if(Request::hasCookie('gh_token'))
    {
        $cookie = Cookie::get('gh_token');
    }
    else
    {
        $cookie = $this->setCookie();
    }

    foreach ($orderDetails as $orderDetail) 
    {
        $productData= [];

        $productData = $this->product->fetchProductDetails($orderDetail->product_id);

        if(!empty($productData))
        {   
            if($productData['product_type']=='SCHEDULED')
            {
                $prescription= 'Yes';
            }
            else
            {
                $prescription = 'No';
            }

            $options=['product_code' => $productData['product_code'],
            'prescription' => $prescription,
            'manufacturer' => $productData['manufacturer'],
            'salt'         => $productData['salts'],
            'unit'         => $productData['unit'],
            'packing'      => $productData['packing']
            ];

            ShoppingCart::instance($cookie)->add($productData['id'],$productData['product_name'],$orderDetail->quantity,$productData['product_mrp'],$options);
        }
        else
        {
            Flash::error('Unable to reorder your order..');
            return Redirect::route('my-orders');
        }
    }

    $cartData = ShoppingCart::instance($cookie)->content();

    if(!$cartData->isEmpty() and $cookie != NULL and Auth::check() == TRUE)
    {
        $this->addProductInCartToDb($cartData,$cookie); 
    }

    $itemsCount= ShoppingCart::instance($cookie)->count();

    $cartTotal = ShoppingCart::instance($cookie)->total();

    return view('cart.show',compact('cartData','itemsCount','cartTotal'));
}

private function setCookie()
{

    $cookie = bin2hex(uniqid('gh',TRUE));

    Cookie::queue('gh_token',$cookie,2628000);

    return $cookie;
}

public function updateProductInCart($customerId = NULL , $isApi = false,$orderId = NULL,$quantity = NULL,$productCode = NULL)
{   
    if($isApi)
    {
        return $this->updateProductInCartToDbForApi($customerId,$isApi,$orderId,$quantity,$productCode);
    }
    else
    {
        $input=Request::all();

        $cookie = Cookie::get('gh_token');

        ShoppingCart::instance($cookie)->update($input['rowId'],$input['quantity']);

        if(Auth::check())
        {
            $this->updateProductInCartToDb($input['rowId'],$cookie);
        }

        return ['status'=>'ok'];
    }
}

public function deleteProductFromCart()
{
    $input=Request::all();

    $cookie = Cookie::get('gh_token');

    $cartData = ShoppingCart::instance($cookie)->get($input['rowId']);


    if(Auth::check())
    {
        $this->deleteProductFromDb($cartData,$cookie);
    }

    ShoppingCart::instance($cookie)->remove($input['rowId']);

    return ['status'=>'ok'];
}

public function getCartDataUserLoggedIn($customerId = NULL,$isApi = false)
{
    if($isApi)
    {
        return $this->getCartDataBYUid($customerId,$isApi);
    }
    else
    {
        if(Request::hasCookie('gh_token'))
        {
           return $this->getCartDataByToken($customerId,$isApi);
       }
       else
       {
           return $this->getCartDataBYUid($customerId,$isApi);
       }
   }
}

public function getCartDataUserNotLoggedIn()
{
    if(Request::hasCookie('gh_token'))
    {                   
       return $this->getCartDataByToken();
   }
   else
   {
    $cartData=Collection::make();
    return $this->getShowResponse($cartData);
}
}


public function addProductInCartToDb($cartData,$cookie,$isApi = false,$customerId = NULL)
{                
    return $this->order->createOrder($cartData,$cookie,$isApi,$customerId);
}

public function updateProductInCartToDb($rowId,$cookie)
{                
    $cartData= ShoppingCart::instance($cookie)->get($rowId);

    if(!$cartData->isEmpty())
    {
        $product_code = $cartData->options->product_code;
        $quantity = $cartData->qty;

        return $this->order->updateOrderQuanity($product_code,NULL,$quantity,$cookie);
    }
}    

public function updateProductInCartToDbForApi($customerId,$isApi,$orderId,$quantity,$productCode)
{                
    return $this->order->updateOrderQuanity($productCode,$orderId,$quantity,NULL);
}    

public function deleteProductFromDb($cartData,$cookie)
{                
    if(!$cartData->isEmpty())
    {
        $product_code = $cartData->options->product_code;
        $quantity = $cartData->qty;

        return $this->order->deleteOrderDetails($product_code,NULL,$quantity,$cookie);
    }
}

public function getCartDataByToken($isApi = false)
{
    $cookie = Request::cookie('gh_token');
    $cartData = ShoppingCart::instance($cookie)->content();

    if(!$cartData->isEmpty())
    {  
       $itemsCount = ShoppingCart::instance($cookie)->count();

       return $this->getShowResponse($cartData,$itemsCount,$cookie);
   }
   else
   {
            // $cartData = $this->getCartDataFromDbByToken($cookie);

            // $cartData=Collection::make();

            // if(!$cartData->isEmpty())
            // {
            //     $itemsCount = ShoppingCart::instance($cookie)->count();

            //     return $this->getShowResponse($cartData,$itemsCount,$cookie);
            // }
            // else
            // {
    $cartData=Collection::make();

    return $this->getShowResponse($cartData);
            // }
}
}

public function getCartDataBYUid($customerId = NULL,$isApi = false)
{
    $cookie = $this->setCookie();

    $uid = ($customerId != NULL)? $customerId : Auth::user()->id;

    $cartData = $this->getCartDataFromDbByUidAndUpdateToken($uid,$cookie);

    if(!$cartData->isEmpty())
    {
       foreach ($cartData as $data) {
        $productData = $this->product->fetchProductDetails($data->product_id);

        if($productData['is_prescription_drug']=='YES')
        {
            $prescription= 'Yes';

        }
        else
        {
            $prescription = 'No';
        }

        $options = ['product_code' => $productData['product_code'],
        'prescription' => $prescription,
        'manufacturer' => $productData['company'],
        'salt'         => $productData['salts'],
        'unit'         => $productData['unit'],
        'packing'      => $productData['packing']
        ];

        ShoppingCart::instance($cookie)->add($productData['id'],$productData['product_name'],$data->quantity,$productData['product_mrp'],$options);

    }

    $cartData = ShoppingCart::instance($cookie)->content();
    $cartData->total = ShoppingCart::instance($cookie)->total();
    if($isApi)
    {

        return $cartData;
    }

    return $this->getShowResponse($cartData);
}
else
{
   if($isApi)
   {
    return $cartData;
}
return $this->getShowResponse($cartData);
}
}

public function getCartDataFromDbByToken($token)
{
        //get the cart data db by token
    return $this->order->getOrderDetailsByToken($token);

}

public function getCartDataFromDbByUidAndUpdateToken($uid,$token)
{
    return $this->order->getOrderDetailsByUserIdAndUpdateToken($uid,$token);
}

public function getShowResponse($cartData=NULL,$itemsCount=NULL,$cookie=NULL)
{
  if($cookie!=NULL)
  {
      $response = new \Illuminate\Http\Response(view('cart.show',compact('cartData','itemsCount')));
      $response->withCookie($cookie);
  }
  else
  {
      $response = new \Illuminate\Http\Response(view('cart.show',compact('cartData','itemsCount')));
  }

  return $response;
}

    // public function ifCartEmpty()
    // {
    //     if(Request::hasCookie('gh_token') != FALSE)
    //     {                   
    //        $cartData = ShoppingCart::instance($token)
    //     }
    // }
    // 

public function getScheduledDrugsFromCart()
{
    if(Request::hasCookie('gh_token'))
    {       
       $token =  Cookie::get('gh_token');         
       $cartData = ShoppingCart::instance($token)->content();

       $name = [];

       foreach ($cartData as $data) {

        if($data->options->prescription!='Yes')
        {
            $name[] = $data->name;
        }

    }

    return $name ;
}
}

    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator($input)
    {   
        return Validator::make($input,
            array(
                'payment_type' => 'required'
                )
            );
    }
}
