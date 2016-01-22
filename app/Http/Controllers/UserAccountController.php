<?php namespace App\Http\Controllers;

use Auth;
use Hash;
use Flash;
use Request;
use Redirect;
use Validator;
use App\Order as Order;
use App\Address as Address;
use App\Product as Product;
use App\Customer as Customer;
use Illuminate\Support\Collection;
use App\PaymentType as PaymentType;
use App\Http\Controllers\Controller;
use App\OrderDetails as OrderDetails;
use Illuminate\Support\Facades\Input;
use App\Http\Contracts\Order as OrderContract;
use App\Http\Controllers\Traits\Order as OrderTrait;
use App\Http\Contracts\UserAccount as UserAccountContract;
use App\Http\Controllers\Traits\DocumentUpload as DocumentUploadTrait;

class UserAccountController extends Controller implements UserAccountContract
{
    use OrderTrait,DocumentUploadTrait;

    /**
     * Get the user account info view
     * 
     * @return  \Illuminate\Http\Response
     */
    public function getUserAccount()
    {
        $user = Customer::find(Auth::user()->id);
        
        return view('myaccounts.account', compact('user'));
    }

    /**
     * Handles the form post functionality
     * of account info form
     * 
     * @return  \Illuminate\Http\Response
     */
    public function postUserAccount()
    {
        $input = Request::all();

        $formPosted = $this->getWhichFormIsPosted($input);

        switch ($formPosted) {
            case 'account_info':
                return $this->updateUserAccountInfo($input);
                break;
            
            case 'change_password':
                return $this->changeUserAccountPassword($input);
                break;
            default:
                return Redirect::route('my-account-info');
        }
    }

    /**
     * Handles the funtionality of user my addresses feature
     * 
     * @return Illuminate\View
     */
    public function userAddresses()
    {
        $user = Customer::find(Auth::user()->id);
        $userAddresses = $user->addresses;

        return view('myaccounts.user-address', compact('userAddresses'));
    }

    /**
     * Handles the funtionality of user my documents feature
     *
     * @param   string $type (Type of user documents)
     * @return 	Illuminate\View
     */
    public function userDocuments($type)
    {
        $user = Customer::find(Auth::user()->id);
        $documents = $user->documents()->where(['document_type' => $type])->get();

        return view('myaccounts.documents', compact('documents', 'type'));
    }

    /**
     * Handles the funtionality of user my orders feature
     * 
     * @return Illuminate\View
     */
    public function userOrders()
    {
        $user = Customer::find(Auth::user()->id);
        $userOrders = $user->orders;

        $names = [];
        $orderStatus = [] ;
        
        if (!$userOrders->isEmpty()) {
            foreach ($userOrders as $userOrder) {
                if ($userOrder->order_status == 0) {
                    continue;
                }
                $address = json_decode($userOrder->shipping_address);
                $names[$userOrder->id] = $address->name;

                $orderStatus[$userOrder->id] = Order::getOrderStatusName($userOrder->order_status);
            }
        }
        return view('myaccounts.user-orders', compact('userOrders', 'names', 'orderStatus'));
    }

    /**
     * Get order details by order id
     * 
     * @param  $id  order id 
     * @return \Illuminate\Http\Response     
     */
    public function userOrderDetails($id)
    {
        $prescriptions = $this->getPrescriptions($id);
        return $this->processOrderDetails($id, 'myaccounts.user-order-details', 'my-orders', $prescriptions);
    }

    /**
     * Handles the funtionality of user my cart feature
     * 
     * @return
     */
    public function userCart()
    {
    }

    /**
     * Print the order with the given order id 
     * @param  int $orderId 
     * 
     * @return Illuminate\View
     */
    public function printOrder($orderId)
    {
        return $this->processOrderDetails($orderId, 'myaccounts.print-order');
    }
}
