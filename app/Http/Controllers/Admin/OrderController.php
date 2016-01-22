<?php namespace App\Http\Controllers\Admin;

use Flash;
use Redirect;
use Sentinel;
use App\Order;
use App\Store;
use App\Customer;
use App\Document;
use App\OrderDetails;
use App\Http\Requests;
use App\OrderActionLog;
use Illuminate\Http\Request;
use App\Events\OrderStatusUpdated;
use Illuminate\Support\Facades\DB;
use App\Events\CustomerOrderRejected;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use App\Events\PrescriptionForOrderIsRequired;
use App\Http\Controllers\Controller as Controller;
use App\Http\Controllers\Traits\Order as OrderTrait;
use App\Http\Controllers\Admin\postUpdateOrderStatus;
use App\Http\Controllers\Admin\Traits\Logistics as Logistics;

class OrderController extends Controller
{
    use OrderTrait,Logistics;
    /**
     * Important Note  :
     *
     * On Every Event customer needs to get informed via email as of now . 
     * Some more mediums will beadded on later on based on the requirements.
     */
    
   /**
    * List all orders 
    * 
    * @return [type] [description]
    */
   public function listAllOrders()
   {
       $user = Sentinel::getUser();

       if ($user != null) {
           $storeId = Store::getStoreIdByUid($user->id);
           if ($storeId != null) {
               $orders = Order::getAllOrdersByStoreId($storeId);
               return View('admin.orders.index', compact('orders'));
           }
       }

       // Grab all the orders except qoutes..
       $orders = Order::where('order_status', '!=', 0)->orderBy('created_at','desc')->get();
       // dd($orders);
        //  Show the page
       return View('admin.orders.index', compact('orders'));
   }

    public function show($orderId)
    {
        $this->logAction('show', $orderId);

        $prescriptions = $this->getPrescriptions($orderId);
        return $this->processOrderDetails($orderId, 'admin.orders.order-details', 'orders', $prescriptions);
    }

    public function getRejectOrder($orderId)
    {
        return view('admin.orders.reject-order', compact('orderId'));
    }

    public function postRejectOrder(Request $request)
    {
        $input = $request->all();

        $rules = ['rejection_reason' => 'required','order_id' => 'required|integer'];

        $validator = Validator::make($input, $rules);
    
        if ($validator->fails()) {
            return Redirect::to(route('orders.rejectOrder', $input['order_id']))->withInput()
        ->withErrors($validator);
        }

        $order = Order::find($input['order_id']);
    
        if ($order != null) {
            $this->logAction('postRejectOrder', $order->id);
            
            $customerId = $order->customer_id;
            $customer = Customer::find($customerId);

            if ($customer != null) {
                if (Event::fire(new CustomerOrderRejected($customer->name, $customer->email, $input['rejection_reason'], $input['order_id']))) {

                    //update the order status ..
                $order->order_status = 6;
                    $order->reject_reason = $input['rejection_reason'];
                    $order->save();

                    Flash::success('Order rejected successfully .. Email sent to customer');
                    return Redirect::to(route('orders'));
                }
                Flash::warning('Unable to reject the order .. please try again');
                return Redirect::to(route('orders.show', $input['order_id']));
            }
            Flash::warning('Unable to find the customer details..');
            return Redirect::to(route('orders'));
        }
        Flash::warning('Unable to find the order ..');
        return Redirect::to(route('orders'));
    }

    public function askForPrescription($orderId)
    {
        $this->logAction('askForPrescription', $orderId);
        
        // fire an email event and notify the user
        // that for they need to upload the prescription 
        // for the order .
        $order = Order::find($orderId);
        
            // if order status is already 'Prescription Awaited'
        if ($order->order_status  == 6) {
            Flash::warning('Email has already been sent to the customer for the prescription ..');
            return Redirect::to(route('orders.show', $orderId));
        }

        $customerId = $order->customer_id;
        $customer = Customer::find($customerId);


        if (Event::fire(new PrescriptionForOrderIsRequired($orderId, $customer))) {
            //update the order status to on hold .. decide the code for on 
            //hold and uncomment the below code and set the the appropriate
            //order status..

        $order->order_status = 6;

            $order->save();

            Flash::success('Email Sent to customer for prescription ..');
            return Redirect::to(route('orders.show', $orderId));
        }
        Flash::error('Unable to send email to the customer for prescription .. Please try again . !!');
        return Redirect::to(route('orders.show', $orderId));
    }

    public function askForPrescriptionUpdate($prescriptionId, $orderId)
    {
        $this->logAction('askForPrescriptionUpdate',$orderId);

        $prescription = Document::find($prescriptionId);
        $order = Order::find($orderId);
    
        // if order status is already 'Prescription Awaited'
    if ($order->order_status  == 7) {
        Flash::warning('Email has already been sent to the customer for the prescription udpate..');
        return Redirect::to(route('orders.show', $orderId));
    }

        $customerId = $order->customer_id;
        $customer = Customer::find($customerId);


        if (Event::fire(new PrescriptionForOrderIsRequired($orderId, $customer))) {
            //update the order status to on hold .. decide the code for on 
            //hold and uncomment the below code and set the the appropriate
            //order status..

        $order->order_status = 7;

            $order->save();

            Flash::success('Email Sent to customer for prescription update ..');
            return Redirect::to(route('orders.show', $orderId));
        }
        Flash::error('Unable to send email to the customer for prescription update .. Please try again . !!');
        return Redirect::to(route('orders.show', $orderId));
    }

    public function getUpdateOrderStatus($orderId)
    {
        $orderStatuses = Order::getOrderStatuses();

        return view('admin.orders.update-order-status', compact('orderId', 'orderStatuses'));
    }

    public function postUpdateOrderStatus(Request $request)
    {
        $input = $request->all();

        $rules = ['order_status' => 'required','order_id' => 'required|integer'];

        $validator = Validator::make($input, $rules);
    
        if ($validator->fails()) {
            return Redirect::to(route('get-update-order-status'))->withInput()
        ->withErrors($validator);
        }

        $order = Order::find($input['order_id']);

        $currentOrderStatus = Order::getOrderStatusName($order->order_status);

        if ($order != null) {
        // if status is Under Shipment whose code is 8
        if ($input['order_status'] == 8) {
            if ($this->addOrderToFarEye($input['order_id']) == false) {
                Flash::error('Unable to push to order to the FarEye Logistics Service . Please Try Again ..');
                return Redirect::to(route('orders.show', $input['order_id']));
            }
        }

            if ($this->updateOrderStatus($input['order_status'], $order)) {

            $updatedOrderStatus = Order::getOrderStatusName($input['order_status']);

            $this->logAction('postUpdateOrderStatus',$order->id, $currentOrderStatus,$updatedOrderStatus);

            //fire event for the order status update mail .. 
            $customerId = $order->customer_id;
                $customer = Customer::find($customerId);

                if ($customer != null) {
                    $orderStatusName = Order::getOrderStatusName($input['order_status']);
                    Event::fire(new OrderStatusUpdated($customer->name, $customer->email, $orderStatusName, $input['order_id']));
                }
                
                Flash::success('Order status has been updated successfully ..');
                return Redirect::to(route('orders.show', $input['order_id']));
            }
        }
    }

    public function getEditOrder($orderId)
    {
        $prescriptions = $this->getPrescriptions($orderId);
        return $this->processOrderDetails($orderId, 'admin.orders.edit', 'orders', $prescriptions);

    // $order = Order::find($orderId);
        // dd($order);
    // if (!empty($order)) {
    //     $orderDetails = $this->order->getOrderDetails($order->id);

            // we need companies name for product lets get that
        // $companies = $this->getCompaniesFromOrderDetails($orderDetails);

            /**
             *  Note : Need the get the packing and unit of 
             *         the product .This Step needs to be 
             *         done when the complete actual data
             *         is imported.  
             *         
             */
        //     if (!empty($orderDetails) && !empty($companies)) {
        //         return view('admin.orders.edit', compact('orderDetails', 'companies'));
        //     } else {
        //         Flash::error('Unable to fetch the order details ..');
        //         return Redirect::to(route('orders.show', $orderId));
        //     }
        // } else {
        //     Flash::error('No order details found ..');
        //     return Redirect::to(route('orders.show', $orderId));
        // }
    }

    public function postEditOrder(Request $request, $orderId)
    {
        $input = $request->all();

        if (isset($input['isDelete'])) {
            //delete request 
                if ($input['rowId'] != null and $orderId!=null) {
                    DB::beginTransaction();
                    $orderDetails = OrderDetails::find($input['rowId']);

                    $order = Order::find($orderId);
                    $orderDetails1 = $order->orderDetails;

                    if ($orderDetails1->count() == 1) {
                        return ['status' => 3]; // only single item in the cart cannot delete it..
                    }

                    if ($orderDetails->delete()) {
                        $order = Order::find($orderId);
                        $orderDetails1 = $order->orderDetails;
                        $cartTotal = $this->calculateTotal($orderDetails1);
                    
                        if ($cartTotal != 0) {
                            $cartTotal = (($cartTotal/100)*85); // since there is 15% discounts so (100-15 = 85)

                        $tax = (($cartTotal/100)*12);

                            $grandTotal = $cartTotal + $tax;
                            $order->order_total = round($grandTotal,2);

                            if ($order->save()) {
                                DB::commit();
                                $this->logAction('postEditOrder',$orderId);
                                return ['status' => 1]; // success
                            }
                        }
                    }
                    DB::rollBack();
                    return ['status' => 2 ]; //means unable to perform the delete
                }
            return ['status' => 0 ]; // invalid input provided
        } else {
            // update request 
         if ($input['rowId'] != null and $input['quantity'] != null and $orderId!=null) {
             DB::beginTransaction();
             $orderDetails = OrderDetails::find($input['rowId']);

             if ($orderDetails != null) {
                 $orderDetails->quantity = $input['quantity'];

                 if ($orderDetails->save()) {
                     $order = Order::find($orderId);
                     $orderDetails1 = $order->orderDetails;
                     $cartTotal = $this->calculateTotal($orderDetails1);

                     if ($cartTotal != 0) {
                         $cartTotal = (($cartTotal/100)*85); // since there is 15% discounts so (100-15 = 85)

                            $tax = (($cartTotal/100)*12);

                         $grandTotal = $cartTotal + $tax;
                         $order->order_total = $grandTotal;

                         if ($order->save()) {
                             DB::commit();
                             return ['status' => 1]; // success
                         }
                     }
                 }
             }
             DB::rollBack();
             return ['status' => 2 ]; //means unable to perform the udpate
         }
            return ['status' => 0 ]; // invalid input provided
        }
    }

    public function viewLogs($orderId)
    {
        if($orderId == NULL){
            Flash::error('No Order Id Provided');
            return redirect()->back();
        }

        $orderLogs = OrderActionLog::where('order_id',$orderId)->get();

        return view('admin.orders.view-logs',compact('orderLogs','orderId'));        
    }

    protected function calculateTotal($orderDetails)
    {
        $total = 0;

        if (!$orderDetails->isEmpty()) {
            foreach ($orderDetails as $orderDetail) {
                $total += $orderDetail->quantity * $orderDetail->price;
            }
        }
        return $total;
    }

    protected function logAction($action, $orderId , $currentOrderStatus = NULL , $updatedOrderStatus = NULL)
    {
        $datArray = [];

        $user = Sentinel::getUser();
        $dataArray['user_id'] = $user->id;
        $dataArray['name'] = $user->first_name . ' ' . $user->last_name;
        $dataArray['order_id'] = $orderId;
        
        $roles = $user->roles;

        if (!$roles->isEmpty()) {
            $dataArray['user_role'] = $roles->first()->name;
        }

        switch ($action) {
                case 'show':
                    $dataArray['description'] =  'User With Name : '. $dataArray['name'] .
                                                ' viewed the order details with id : ' .
                                                $orderId;
                    break;
                
                case 'postRejectOrder':
                    $dataArray['description'] =  'User With Name : '. $dataArray['name'] .
                                                ' performed the reject order action on order id : ' .
                                                $orderId;
                    break;

                case 'askForPrescription':
                    $dataArray['description'] =  'User With Name : '. $dataArray['name'] .
                                                ' asked for prescription on order id : ' .
                                                $orderId;
                    break;

                case 'askForPrescriptionUpdate':
                    $dataArray['description'] =  'User With Name : '. $dataArray['name'] .
                                                ' asked for prescription update on order id : ' .
                                                $orderId;
                break;
                
                case 'askForPrescriptionUpdate':
                    $dataArray['description'] =  'User With Name : '. $dataArray['name'] .
                                                ' asked for prescription update on order id : ' .
                                                $orderId;                
                break;

                case 'askForPrescriptionUpdate':
                    $dataArray['description'] =  'User With Name : '. $dataArray['name'] .
                                                ' asked for prescription update on order id : ' .
                                                $orderId;    
                break;

                case 'postUpdateOrderStatus':
                    $dataArray['description'] =  'User With Name : '. $dataArray['name'] .
                                                ' updated the order status from  ' . $currentOrderStatus . 
                                                ' to '. $updatedOrderStatus. ' for order id : '.
                                                $orderId;

                break;

                case 'postEditOrder':
                    $dataArray['description'] =  'User With Name : '. $dataArray['name'] .
                                                'performed edit operation on order with id : '.
                                                $orderId;

                break;
                
            }

        if (OrderActionLog::logAction($dataArray)) {
            return true;
        }
        return false;
    }
}
