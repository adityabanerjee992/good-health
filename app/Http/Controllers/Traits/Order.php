<?php  namespace App\Http\Controllers\Traits;

use Auth;
use Hash;
use Flash;
use Request;
use Redirect;
use Validator;
use App\Document;
use App\Address as Address;
use App\Product as Product;
use App\Order as OrderModel;
use App\Customer as Customer;
use Illuminate\Support\Collection;
use App\PaymentType as PaymentType;
use App\OrderDetails as OrderDetails;
use App\Http\Contracts\Order as OrderContract;
use App\Http\Controllers\Traits\Order as OrderTrait;
use App\Http\Contracts\UserAccount as UserAccountContract;

trait Order
{
    /**
     * @var App\Http\Contracts\Order
     */
    protected $orderInstance;

    public function __construct(OrderContract $order)
    {
        $this->orderInstance = $order;
    }

     /**
     * Process the order details for a given order id
     *  
     * @param  int $orderId 
     * @param  string $view 
     * @return mixed
     */
    private function processOrderDetails($orderId, $view,$onErrorRedirectToRoute = NULL,$prescriptions = NULL)
    {
        $order = OrderModel::find($orderId);
        if (!empty($order)) {
            //this should be moved to there respective controllers
            $userAddress = json_decode($order->shipping_address);
            $paymentTypeDetails = $this->getPaymentTypeDetails($order->payment_type_id);
            $orderDetails = $this->orderInstance->getOrderDetails($order->id);
            $orderStatus  = OrderModel::getOrderStatusName($order->order_status);

            // we need companies name for product lets get that
            $companies = $this->getCompaniesFromOrderDetails($orderDetails);

            /**
             *  Note : Need the get the packing and unit of 
             *  	   the product .This Step needs to be 
             *  	   done when the complete actual datatables
             *  	   is imported.  
             *  	   
             */
            if (!empty($userAddress) && !empty($paymentTypeDetails)
                && !empty($orderDetails) && !empty($orderStatus)
                && !empty($companies)) {
                return view($view, compact('userAddress', 'paymentTypeDetails',
                            'orderDetails', 'order', 'orderStatus', 'companies','prescriptions'));
            } else {
                Flash::error('Unable to fetch the order details ..');
                return Redirect::route($onErrorRedirectToRoute);
            }
        } else {
            Flash::error('No order details found ..');
            return Redirect::route($onErrorRedirectToRoute);
        }
    }
    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @param  string $typeOff
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator($input, $typeOff)
    {
        switch ($typeOff) {
            case 'account_info':
                return Validator::make($input,
                    array(
                        'name' => 'required|max:255'    
                    )
                );
                break;


            case 'change_password':
                return Validator::make($input,
                    array(
                        'current_password'    => 'required|min:6',
                        'password'        => 'required',
                        'confirm_password'  => 'required|same:password'
                    )
                );
                break;
            
            default:
                //return nothing 
                break;
        }
    }

    /**
     * Get which form is posted on 
     * account info page 
     * 
     * @param  array   $input 
     * @return mixed   
     */
    private function getWhichFormIsPosted($input)
    {
        if (!is_null($input)) {
            if (isset($input['form']) and $input['form'] != null) {
                return $input['form'];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * Update user account information 
     * 
     * @param  array   $input 
     * @return \Illuminate\Http\Response  
     */
    private function updateUserAccountInfo($input,$isApi = false)
    {
        if($isApi){
            $customer = Customer::find($input['customer_id']);

            $customer->name   = $input['name']; 
            // $customer->gender = $input['gender'];

            if ($customer->save()) {
               return true;
            } else {
                return false;
            }
        }
        else
        {
            $typeOff = 'account_info';

            $validator = $this->validator($input, $typeOff);

            if ($validator->fails()) {
                return Redirect::route('my-account-info')
                                 ->withErrors($validator);
            } else {
                $user = Customer::find(Auth::user()->id);

                $user->name   = $input['name'];
                // $user->gender = $input['gender'];

                if ($user->save()) {
                    Flash::success('Hooray!! Account Information Updated!!..');
                    return Redirect::route('my-account-info');
                } else {
                    Flash::error('Unable To Update Account Information . Please Try Again Later !!..');
                    return Redirect::route('my-account-info');
                }
            }
            /* fall back */
            Flash::error('Unable To Update Account Information . Please Try Again Later !!..');
            return Redirect::route('my-account-info');
        }
    }

    /**
     * Change user account password.
     * 
     * @param  array   $input 
     * @return \Illuminate\Http\Response  
     */
    private function changeUserAccountPassword($input,$isApi = false)
    {
        if($isApi){
            $customer = Customer::find($input['customer_id']);
            
            // Get passwords from the user's input
            $current_password = $input['current_password'];
            $password          = $input['password'];
            // test input password against the existing one
            if (Hash::check($current_password, $customer->getAuthPassword())) {
                $customer->password = Hash::make($password);

                // save the new password
                if ($customer->save()) {
                    return 1; //success
                } else {
                    return 2; //some internal problem
                }
            } else {
              return 3; //customer or user current password is incorrect .
            }
        }
        else
        {
            $typeOff = 'change_password';

            $validator = $this->validator($input, $typeOff);

            if ($validator->fails()) {
                return Redirect::route('my-account-info')
                                 ->withErrors($validator);
            } else {
                // Grab the current user
                $user = Customer::find(Auth::user()->id);

                // Get passwords from the user's input
                $current_password = $input['current_password'];
                $password          = $input['password'];

                // test input password against the existing one
                if (Hash::check($current_password, $user->getAuthPassword())) {
                    $user->password = Hash::make($password);

                    // save the new password
                    if ($user->save()) {
                        Flash::success('Hooray!! Your Account Password Changed SuccessFully . Please Login Again');
                        Auth::logout();
                        return Redirect::route('login');
                    } else {
                        Flash::error('Sorry We Are Unable To Change The Password!!');
                        return Redirect::route('my-account-info');
                    }
                } else {
                    Flash::error('Your Current Password Is Incorrect');
                    return Redirect::route('my-account-info');
                }
            }
            /* fall back */
            Flash::success('Sorry We Are Unable To Change The Password!!');
            return Redirect::route('my-account-info');
        }
    }

    /**
     * Get user address 
     * @param  $addressId
     * @return Illuminate\Support\Collection
     */
    private function getUserAddress($addressId)
    {
        $address = Address::find($addressId);
        return $address;
    }

    /**
     * Get payment type details 
     * @param  $orderId
     * @return Illuminate\Support\Collection
     */
    private function getPaymentTypeDetails($orderId)
    {
        $paymentTypeDetails = PaymentType::find($orderId);
        return $paymentTypeDetails;
    }

    /**
     * Get the companies by looping though 
     * details collection
     * @param  Illuminate\Support\Collection $orderDetails
     * @return array $companies
     */
    private function getCompaniesFromOrderDetails($orderDetails)
    {
        $companies = [];

        foreach ($orderDetails as $orderDetail) {
            $product = Product::find($orderDetail->product_id);
            $comp = $product->companies->all();
            $companies[$orderDetail->product_id] = $comp[0]->company_name;
        }
        return $companies;
    }

    protected function updateOrderStatus($orderStatus,$order)
    {
        if($orderStatus == NULL or $order == NULL){
            return false;
        }        

        //we need to validate the orderstatus id or code 
        if(OrderModel::getOrderStatusName($orderStatus) != NULL){
            //than procede further ..
            $order->order_status = $orderStatus;
            if($order->save()){
                return true;
            }
        }
        return false;
    }   

    protected function getPrescriptions($orderId)
    {
        $prescriptions = Document::where(['order_id' => $orderId, 'document_type' => 'prescription'])->get();
        return $prescriptions;
    }
}
