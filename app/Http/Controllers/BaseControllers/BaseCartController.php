<?php namespace App\Http\Controllers\BaseControllers;

use URL;
use Auth;
use Cart;
use Flash;
use Input;
use Cookie;
use Request;
use Session;
use Redirect;
use Response;
use Validator;
use App\Document;
use App\Http\Requests;
use App\Address as Address;
use App\Order as OrderModel;
use App\Customer as Customer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\PaymentType as PaymentType;
use App\Http\Contracts\Order as Order;
use App\Http\Contracts\Product as Product;
use App\Events\SendStatementOfOrderToCustomer;
use App\Http\Controllers\Traits\Order as OrderTrait;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Contracts\DocumentUpload as DocumentUpload;

class BaseCartController extends BaseController
{
    use OrderTrait;

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

    public function __construct(Order $order, Product $product, documentUpload $documentUpload, Address $address)
    {
        $this->order = $order;

        $this->product = $product;

        $this->documentUpload = $documentUpload;

        $this->address = $address;
    }
    
    public function getUploadPrescription()
    {
        if (Auth::Check()) {
            $drugsName = $this->getScheduledDrugsFromCart();

            if ($drugsName != null) {
                return View('cart.upload-prescription', compact('drugsName'));
            } else {
                return redirect('/cart/address');
            }
        } else {
            return redirect('auth/login');
        }
    }
    
    public function getChoosePrescription()
    {
        if (Auth::Check()) {
            $user = Customer::find(Auth::user()->id);

            $documents = $user->documents()->orderBy('created_at', 'DESC')->paginate(5);

            if ($documents != null) {
                return view('cart.documents', compact('documents'));
            } else {
                Flash::error('No Prescriptiosn Found .. Please add a new one..');
                return redirect(route('upload-prescription'));
            }
        } else {
            return redirect('auth/login');
        }
    }

    public function linkPrescriptionToOrder($id)
    {
        if (Auth::Check()) {
            $user = Customer::find(Auth::user()->id);

            $existingDocument = $user->documents()->where(['id' => $id, 'customer_id' => $user->id])->get();
            
            if ($existingDocument->isEmpty()) {
                //it means that document id is not valid ..
                Flash::error('Trying to link an invalid document ..');
                return redirect(route('upload-prescription'));
            }

            $orderId= $this->order->getOrderId(Auth::User()->id);

            $existingDocument = $existingDocument->first();

            if ($existingDocument->order_id != null) {
                if ($existingDocument->order_id == $orderId) {
                    // you are trying to re-link the same doc to the same order id 
                    // so in that case just move to the next step..
                    return redirect('/cart/address');
                }

                if ($this->documentUpload->checkIfPrescriptionExistsForSameOrderId($orderId)) {
                    if ($this->documentUpload->detachExistingPrescription($orderId) == false) {
                        return false;
                    }
                }
                $document['order_id'] = $orderId;
                $document['customer_id'] = Auth::user()->id;
                $document['document_name'] = $existingDocument->document_name;
                $document['document_original_name'] = $existingDocument->document_original_name;
                
                $document['patient_name'] = $existingDocument->patient_name;
                $document['prescription_date'] = $existingDocument->prescription_date;
                $document['document_notes'] = $existingDocument->document_notes;

                $document['document_type'] = $existingDocument->document_type;
                $document['document_storage_path'] = $existingDocument->document_storage_path;

                if (Document::firstOrCreate($document)) {
                    return redirect('/cart/address');
                } else {
                    Flash::error('Unable to link the document .. please try again ');
                    return redirect(route('upload-prescription'));
                }
            } else {
                if ($this->documentUpload->checkIfPrescriptionExistsForSameOrderId($orderId)) {
                    if ($this->documentUpload->detachExistingPrescription($orderId) == false) {
                        return false;
                    }
                }
                
                $existingDocument->order_id = $orderId;

                if ($existingDocument->save()) {
                    // dd($document);
                    return redirect('/cart/address');
                }
                Flash::error('Unable to link the document .. please try again ');
                return redirect(route('upload-prescription'));
            }
        } else {
            return redirect('auth/login');
        }
    }

    public function linkAddressToOrder($id)
    {
        $user = Customer::find(Auth::user()->id);

        $existingAddress = $user->addresses()->where(['id' => $id, 'customer_id' => $user->id])->get();

        if ($existingAddress->isEmpty()) {
            //it means that address id is not valid ..
            Flash::error('Trying to link an invalid address ..');
            return redirect(route('cart-address'));
        }

        $storeResult = $this->ifStoreExists($existingAddress->first()->pincode);
        
        if ($storeResult == false) {
            Flash::error(' Opps it\'s looks like that we dont have any store for the choosen address..');
            return redirect(route('cart-address'));
        }

        $orderId= $this->order->getOrderId(Auth::User()->id);

        if ($orderId != null) {
            $order = \App\Order::find($orderId);
            $order->store_id = $storeResult->first()->id;
            $order->shipping_address = json_encode($existingAddress->first()->toArray());
            $order->billing_address = json_encode($existingAddress->first()->toArray());
            
            if ($order->save()) {
                return redirect(route('order-summary'));
            }

            Flash:error('Unable to link the address .. please give it a another try');
            return redirect(route('cart-address'));
        }
        return redirect(route('home'));
    }

    public function ifStoreExists($pincode)
    {
        //if the store exsit  return true or false
        $pincode = \App\Pincode::where('pincode', $pincode)->get();

        if ($pincode->isEmpty()) {
            // the suplied pincode does not exists ..so return false
           return false;
        }

        $stores = $pincode->first()->stores;

        if ($stores->isEmpty()) {
            //if there are no stores for suplied pincode than return false..
        return false;
        }
    //rest return true..
    return $stores;
    }

    public function postUploadPrescription()
    {
        if (Auth::Check()) {
            $input = Request::all();

            // dd(Request::server('HTTP_REFERER'));

            $validator = Validator::make($input, [
            'patient_name' => 'required',
            'disclaimer' => 'required',
            'prescription_date' => 'required|date',
            'notes' => 'required',
            'prescription_file' => 'required|mimes:jpeg,png|max:1000',
            ]);

            if (Request::ajax()) {

                // This portion has been removed  as per client Requirements. 
                // if (strtotime($input['prescription_date']) < strtotime('-15 days')) {
                //     $validator->after(function ($validator) {
                //     $validator->errors()->add('prescription_date', 'Prescription Date Should Not Be Older Than 15 Days.');
                // });
                // }
                if (strtotime($input['prescription_date']) > strtotime('today')) {
                    $validator->after(function ($validator) {
                    $validator->errors()->add('prescription_date', 'Prescription Date Should Not Be A Date In Future.');
                });
                }
            
                if ($validator->fails()) {
                    return response($validator->messages(), 422);
                }
            }

            if (Input::hasFile('prescription_file')) {
                $file = Input::file('prescription_file');

                $orderId= (isset($input['order_id']) and $input['order_id'] != null)? $input['order_id'] : $this->order->getOrderId(Auth::User()->id);
                if(strpos(Request::server('HTTP_REFERER'),'medical-report')){
                    $dest = base_path().'/storage/app/customer/'.Auth::user()->id.'/medicalreports';
                        $dest1 ='/customer/'.Auth::user()->id.'/medicalreports/';
                    $documentType = "medical-report";   

                }else{

                    $dest = base_path().'/storage/app/customer/'.Auth::user()->id.'/prescriptions';
                    $dest1 ='/customer/'.Auth::user()->id.'/prescriptions/';
                    $documentType = "prescription";
                }

                if ($this->documentUpload->store($input, $orderId, $dest1, $documentType)) {
                    if (Request::ajax()) {
                        if ((isset($input['order_id']) and $input['order_id'] != null)) {
                            return response(['message' => 'Prescription Uploaded Successfully ..']);
                        }
                        if(strpos(Request::server('HTTP_REFERER'),'my-documents/prescription')){
                            return response(['message' => 'Prescription Uploaded Successfully ..']);
                        }
                        return response(['location'=>'address', 'message' => 'Prescription Uploaded Successfully ..']);
                    }
                    return redirect('cart/address');
                } else {
                    if (Request::ajax()) {
                        return response(['message' => 'Unable To Upload Prescription.. Please Try Again ..']);
                    }
                }
            }
        }
    }

    public function address()
    {
        $addressData = Address::where(['customer_id' => Auth::user()->id])->get();

        return View('cart.address', compact('addressData'));
    }

    public function orderSummary()
    {
        $orderId = Session::get('order_id');

        $orderDetails = $this->order->getOrderDetails($orderId);

        // dd($orderDetails); 
        
        $paymentTypes = PaymentType::all();

        return View('cart.order-summary', compact('orderDetails', 'paymentTypes'));
    }

    public function orderConfirmation()
    {
        $input = Request::all();

        $validator =$this->validator($input);

        if ($validator->fails()) {
            Flash::error('Please choose your payment method ..');
            return Redirect::route('order-summary');
        }

        $orderId = Session::get('order_id');
        $orderStatus = $this->getOrderStatus($orderId);


        //check for pincode and store mapping . 
        //if no store is mapped to the pincode 
        //than needs to give the error to the user man .

        //$this->checkForPincodeStoreMapping();

    if (!is_null($orderId)) {
        $cookie = Cookie::get('gh_token');

        $cartTotal = Cart::instance($cookie)->total();

            /**
             *  Important : Temporary (its fixed now )
             *  
             * This logic is temporary here to calculate the 
             * cart total . When the dicounts rules are 
             * defined and payment calculation procedure gets to be
             * defined than this needs to be changed..
             */
            
            $cartTotal = (($cartTotal/100)*85); // since there is 15% discounts so (100-15 = 85)

            $tax = (($cartTotal/100)*12);

        $grandTotal = round((
                $cartTotal + $tax), 2);

        $orderData = [
                'order_status' => $orderStatus ,
                
                'order_total'  => $grandTotal,
                'payment_type_id' => $input['payment_type']
                ];
              
        if ($this->order->udpateOrderData($orderId, $orderData)) {
            $order = OrderModel::find($orderId);
            $this->sendStatementOfOrderToCustomer($order);

                //destroy the cart 
                //destroy the sesson variables 

                Session::forget('order_id');

            Cart::instance($cookie)->destroy();

                //destroy the cookie 
                $cookie = Cookie::forget('gh_token');

                //unsset the session cart count variable
                Session::forget('cart_count');

            return Response::make(View('cart.order-confirmation'))->withCookie($cookie);
        } else {
            dd('Unable to process the order . please try again later on .. ');
        }
    } else {
        return redirect(url(''));
    }
    }

    protected function sendStatementOfOrderToCustomer($orderObject)
    {
        if (!empty($orderObject)) {
            $userAddress = json_decode($orderObject->shipping_address);
            $paymentTypeDetails = $this->getPaymentTypeDetails($orderObject->payment_type_id);
            $orderDetails = $this->order->getOrderDetails($orderObject->id);
            $orderStatus  = OrderModel::getOrderStatusName($orderObject->order_status);

            //fire event for the order status update mail .. 
            $customerId = $orderObject->customer_id;
            $customer = \App\Customer::find($customerId);

            // we need companies name for product lets get that
            $companies = $this->getCompaniesFromOrderDetails($orderDetails);
            // dd($orderDetails);
            if (!empty($userAddress) && !empty($paymentTypeDetails)
                && !empty($orderDetails) && !empty($orderStatus)
                && !empty($companies) && !empty($customer)) {
                // fire the statement of order email event here ..
                    \Event::fire(new SendStatementOfOrderToCustomer($userAddress, $paymentTypeDetails, $orderDetails,
                                                                $orderStatus, $companies, $customer->name, $customer->email));
            }
        }
    }

    public function checkout()
    {
        if (Auth::check()) {
            if (Request::hasCookie('gh_token')) {
                //update the user id in the orders table
                //redirect to upload prescription page.. 
                Cookie::queue('user_id', Auth::user()->id, 2628000);    

                $token = Cookie::get('gh_token');

                $cartData = Cart::instance($token)->content();

                if ($cartData->isEmpty()) {
                    return $this->getShowResponse($cartData);
                }

                if ($this->addProductInCartToDb($cartData, $token)) {
                    return redirect('cart/upload-prescription');
                } else {
                    dd('Some Error Occured Please Try Again Later .. !!');
                }
            } else {
                return redirect(url(''));
            }
        } else {
            return redirect(url('/auth/login/checkout'));
        }
    }

    public function addProductToCart($id, $quantity = null)
    {
        $productData= [];

        $productData = $this->product->fetchProductDetails($id);
        
        if (Request::hasCookie('gh_token')) {
            $cookie = Cookie::get('gh_token');

        } else {
            $cookie = $this->setCookie();
        }
        
        if(Auth::check() != false){
            if(!Cookie::has('user_id')){
                Cookie::queue('user_id', Auth::user()->id, 2628000);    
            }
        }   

        // Cart::instance($cookie)->destroy();
        // dd($productData['is_prescription_drug']);
        if ($productData['is_prescription_drug'] == 'YES') {
            $prescription = 'Yes';
        } else {
            $prescription = 'No';
        }

        if (!empty($productData)) {
            $options=['product_code' => $productData['product_code'],
            'prescription' => $prescription,
            'salt'         => $productData['salts'],
            'unit'         => $productData['unit'],
            'packing'      => $productData['packing']
            ];

            if ($quantity == null) {
                $quantity =1 ;
            }

            Cart::instance($cookie)->add($productData['id'], $productData['product_name'], $quantity, $productData['product_mrp'], $options);

            $cartData = Cart::instance($cookie)->content();

            if (!$cartData->isEmpty() and $cookie != null and Auth::check() == true) {
                $this->addProductInCartToDb($cartData, $cookie);
            }

            $itemsCount= $cartData->count();

            //Set the session cart count 
            session(['cart_count' => $itemsCount]);

            //redirect the user to cart ..
            // return redirect(route('cart'));

            $cartTotal = Cart::instance($cookie)->total();

            session(['show_alert' => 1]);
            // As per client requirement redirect back to the same url 
            return redirect()->back();

            // return view('cart.show', compact('cartData', 'itemsCount', 'cartTotal'));
        } else {
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

       if ($this->order->checkIfOrderExist($orderId)) {
           $orderDetails = $this->order->getOrderDetails($orderId);

           if (is_null($orderDetails)) {
               Flash::error('Unable to reorder your order ..');
               return Redirect::route('my-orders');
           } else {
               return $this->addProductToCartInBulk($orderDetails);
           }
       } else {
           return redirect(route('home'));
       }
   }

   public function cartCancelOrder()
   {
       $input = Request::all();
       $orderId = $input['order_id'];

       if ($this->order->checkIfOrderExist($orderId)) {
            $order = OrderModel::find($orderId);

            $order->order_status = 5 ;//which is cancelled
            
            DB::beginTransaction();
            
            if($order->save()){
                DB::commit();
                Flash::success('Order Cancelled Successfully !');
                return redirect()->back();
            }

            DB::rollback();
        
            Flash::error('Unable to cancel the order please try again.');
            return redirect()->back();            

       } else {
            Flash::error('Order Doesn\'t Exists !');
            return redirect()->back();
       }
   }

    private function addProductToCartInBulk($orderDetails)
    {
        if (Request::hasCookie('gh_token')) {
            $cookie = Cookie::get('gh_token');
        } else {
            $cookie = $this->setCookie();
        }

        foreach ($orderDetails as $orderDetail) {
            $productData= [];

            $productData = $this->product->fetchProductDetails($orderDetail->product_id);

            if (!empty($productData)) {
                if ($productData['is_prescription_drug']=='YES') {
                    $prescription= 'Yes';
                } else {
                    $prescription = 'No';
                }

                $options=['product_code' => $productData['product_code'],
            'prescription' => $prescription,
            'company' => $productData['company'],
            'salt'         => $productData['salts'],
            'unit'         => $productData['unit'],
            'packing'      => $productData['packing']
            ];

                Cart::instance($cookie)->add($productData['id'], $productData['product_name'], $orderDetail->quantity, $productData['product_mrp'], $options);
            } else {
                Flash::error('Unable to reorder your order..');
                return Redirect::route('my-orders');
            }
        }

        $cartData = Cart::instance($cookie)->content();

        $itemsCount= count($cartData);

    //Set the session cart count 
    session(['cart_count' => $itemsCount]);

        if (!$cartData->isEmpty() and $cookie != null and Auth::check() == true) {
            $this->addProductInCartToDb($cartData, $cookie);
        }

        $itemsCount= Cart::instance($cookie)->count();

        $cartTotal = Cart::instance($cookie)->total();

        return view('cart.show', compact('cartData', 'itemsCount', 'cartTotal'));
    }

    protected function getOrderStatus($orderId)
    {
        $document = Document::where(['order_id' => $orderId])->get();

        if (!$document->isEmpty()) {
            return 1; // Means order should go uder review
        }
        return 3; // Order Can go to the processing stage 
    }

    private function setCookie()
    {
        $cookie = bin2hex(uniqid('gh', true));

        Cookie::queue('gh_token', $cookie, 2628000);

        if(Auth::check() != false){
            Cookie::queue('user_id', Auth::user()->id, 2628000);
        }
        return $cookie;
    }

    public function updateProductInCart()
    {
        $input=Request::all();

        $cookie = Cookie::get('gh_token');

        Cart::instance($cookie)->update($input['rowId'], $input['quantity']);
    
        $cartData= Cart::instance($cookie)->content();
    
        $itemsCount = $cartData->count();

        // Set the session cart count 
    session(['cart_count' => $itemsCount]);

        if (Auth::check()) {
            $this->updateProductInCartToDb($input['rowId'], $cookie);
        }

        return ['status'=>'ok'];
    }

    public function deleteProductFromCart()
    {
        $input=Request::all();

        $cookie = Cookie::get('gh_token');

        $cartData = Cart::instance($cookie)->get($input['rowId']);
    
        if (Auth::check()) {
            $this->deleteProductFromDb($cartData, $cookie);
        }
    
        Cart::instance($cookie)->remove($input['rowId']);

        $itemsCount= Cart::instance($cookie)->content()->count();
        //Set the session cart count 
        session(['cart_count' => $itemsCount]);

        return ['status'=>'ok'];
    }

    public function getCartDataUserLoggedIn()
    {
        //if the user is logged in and there is some
    //data in the local broswer storage that needs
    // to be synced with the db or vice versa ..

    // steps to procede 
    // 
    if (Request::hasCookie('gh_token')) {
        return $this->getCartDataByToken();
    } else {
        return $this->getCartDataBYUid();
    }
    }

    public function getCartDataUserNotLoggedIn()
    {
        if (Request::hasCookie('gh_token')) {
            return $this->getCartDataByToken();
        } else {
            $cartData=Collection::make();
            return $this->getShowResponse($cartData);
        }
    }


    public function addProductInCartToDb($cartData, $cookie)
    {
        return $this->order->createOrder($cartData, $cookie);
    }

    public function updateProductInCartToDb($rowId, $cookie)
    {
        $cartData= Cart::instance($cookie)->get($rowId);

        if (!$cartData->isEmpty()) {
            $product_code = $cartData->options->product_code;
            $quantity = $cartData->qty;

            return $this->order->updateOrderQuanity($product_code, null, $quantity, $cookie);
        }
    }

    public function deleteProductFromDb($cartData, $cookie)
    {
        if (!$cartData->isEmpty()) {
            $product_code = $cartData->options->product_code;
            $quantity = $cartData->qty;

            return $this->order->deleteOrderDetails($product_code, null, $quantity, $cookie);
        }
    }

    public function getCartDataByToken()
    {
        $this->syncTokenCartDataWithDb();

        $cookie = Request::cookie('gh_token');
        $cartData = Cart::instance($cookie)->content();

        if (!$cartData->isEmpty()) {
            $itemsCount = Cart::instance($cookie)->content()->count();

            return $this->getShowResponse($cartData, $itemsCount, $cookie);
        } else {
            // $cartData = $this->getCartDataFromDbByToken($cookie);

            // $cartData=Collection::make();

            // if(!$cartData->isEmpty())
            // {
            //     $itemsCount = Cart::instance($cookie)->content()->count();

            //     return $this->getShowResponse($cartData,$itemsCount,$cookie);
            // }
            // else
            // {
        $cartData=Collection::make();

            return $this->getShowResponse($cartData);
            // }
        }
    }

    public function getCartDataBYUid()
    {
        $this->syncTokenCartDataWithDb();

        $cookie = $this->setCookie();

        $uid = Auth::user()->id;

        $cartData = $this->getCartDataFromDbByUidAndUpdateToken($uid, $cookie);

        if (!$cartData->isEmpty()) {
            foreach ($cartData as $data) {
                $productData = $this->product->fetchProductDetails($data->product_id);

                if ($productData['is_prescription_drug']=='YES') {
                    $prescription= 'Yes';
                } else {
                    $prescription = 'No';
                }

                $options = ['product_code' => $productData['product_code'],
            'prescription' => $prescription,
            'company' => $productData['company'],
            'salt'         => $productData['salts'],
            'unit'         => $productData['unit'],
            'packing'      => $productData['packing']
            ];
            
                $quantity = $this->getProductQuantity($data->product_id);

                Cart::instance($cookie)->add($productData['id'], $productData['product_name'], $quantity, $productData['product_mrp'], $options);
            }

            $cartData = Cart::instance($cookie)->content();

            $itemsCount= $cartData->count();
        
        //Set the session cart count 
        session(['cart_count' => $itemsCount]);

            return $this->getShowResponse($cartData, $itemsCount);
        } else {
            $itemsCount= $cartData->count();
            //Set the session cart count 
        session(['cart_count' => $itemsCount]);

            return $this->getShowResponse($cartData, $itemsCount);
        }
    }

    protected function syncTokenCartDataWithDb()
    {
        if (Request::hasCookie('gh_token')) {
            $cookie = Request::cookie('gh_token');
            $cartData = Cart::instance($cookie)->content();

            $this->order->createOrder($cartData, $cookie);
        }
        // get the cart data by token and store the 
        // data to the db ..
    }

    protected function getProductQuantity($productId)
    {
        //default value for quantity ..
    $quantity = 1;
        $orderId = Session::get('order_id');

        if ($orderId != null) {
            $order = \App\Order::find($orderId);

            $orderDetails = $order->orderDetails()->where(['order_id' => $orderId, 'product_id' => $productId])->get();
        
            if (!$orderDetails->isEmpty()) {
                return $orderDetails->first()->quantity;
            }
        }
        return $quantity;
    }

    public function getCartDataFromDbByToken($token)
    {
        //get the cart data db by token
    return $this->order->getOrderDetailsByToken($token);
    }

    public function getCartDataFromDbByUidAndUpdateToken($uid, $token)
    {
        return $this->order->getOrderDetailsByUserIdAndUpdateToken($uid, $token);
    }

    public function getShowResponse($cartData=null, $itemsCount=null, $cookie=null)
    {
        if ($cookie!=null) {
            $response = new \Illuminate\Http\Response(view('cart.show', compact('cartData', 'itemsCount')));
            $response->withCookie($cookie);
        } else {
            $response = new \Illuminate\Http\Response(view('cart.show', compact('cartData', 'itemsCount')));
        }

        return $response;
    }

    // public function ifCartEmpty()
    // {
    //     if(Request::hasCookie('gh_token') != FALSE)
    //     {                   
    //        $cartData = Cart::instance($token)
    //     }
    // }
    // 

public function getScheduledDrugsFromCart()
{
    if (Request::hasCookie('gh_token')) {
        $token =  Cookie::get('gh_token');
        $cartData = Cart::instance($token)->content();

        $name = [];

        foreach ($cartData as $data) {
            if ($data->options->prescription =='Yes') {
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
