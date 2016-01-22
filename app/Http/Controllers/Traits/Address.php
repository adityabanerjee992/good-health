<?php namespace App\Http\Controllers\Traits;

use Auth;
use Flash;
use Input;
use Request;
use Redirect;
use App\Order;
use Validator;
use App\Customer;
use App\Address as AddressModel;
use \Illuminate\Routing\Controller as BaseController;
use App\Exceptions\AddressNotSaved as AddressNotSaved;

trait Address
{
    /**
      * Handles the functionalty of store of new 
      * address
      *
      * @param  bool  $isApi
      * @return mixed
      */
    public function processStore($isApi = false)
    {
        $input = Request::all();
        $validator =$this->validator($input, $isApi, ['customer_id', 'name', 'pincode', 'mobile', 'address', 'city', 'state']);

        $customer_id = null;
      
        if (Request::ajax()) {
            if ($validator->fails()) {
                return response($validator->messages(), 422);
            }
        } else {
            if ($validator->fails()) {
                if ($isApi) {
                    return $validator->messages();
                }
                return Redirect::route('my-address')
         ->withErrors($validator);
            }
        }
        if (isset($input['customer_id'])) {
            $customer_id = $input['customer_id'];
        }
        $data = $this->prepareData($input, $customer_id);
        return $this->storeAddressToDb($data, $isApi);
    }

    /**
      * Handles the functionalty of update 
      * address
      *
      * @param  bool  $isApi
      * @return mixed
      */
    public function processUpdate($isApi = false)
    {
        $input = Request::all();

        $customer_id = null;

        $validator =$this->validator($input, $isApi);

        if ($validator->fails()) {
            
            if ($isApi) {
                return $validator->messages();
            }

            if($input['is_request_from_cart_address_page'] == 1){
              return Redirect::route('cart-address-edit', $input['address_id'])
                               ->withErrors($validator);
            }

            return Redirect::route('edit-address', $input['address_id'])
                             ->withErrors($validator);
        } else {
            if (isset($input['customer_id'])) {
                $customer_id = $input['customer_id'];
            }
            return $this->updateAddressToDb($input, $isApi);
        }
    }

    /**
      * Handles the functionalty of delete 
      * address
      *
      * @param  bool  $isApi
      * @return mixed
      */
  public function processDelete($isApi = false)
  {
      $input = Request::all();

      if (Request::ajax()) {
          if ($this->ifAddressIsLinkedWithAnyOrder($input['address_id'])) {
              return response(['status' => 0,
                           'message'=>'The address which you are trying to delete is linked with some of your order(s).Unable to delete the address']);
          }

          if ($this->deleteAddress($input, $isApi)) {
              return response(['status' => 1, 'message' => 'Address Deleted Successfully']);
          }
      } else {
          $customer_id = null;

          $validator =$this->validator($input, $isApi, ['customer_id', 'address_id']);

          if ($validator->fails()) {
              if ($isApi) {
                  return $validator->messages();
              }
              return Redirect::route('my-address')
         ->withErrors($validator);
          } else {
              return $this->deleteAddress($input, $isApi);
          }
      }
  }

    protected function ifAddressIsLinkedWithAnyOrder($addressId)
    {
        if (Order::where(['address_id' => $addressId])->get()->count() != 0) {
            return true;
        }
        return false;
    }

     /**
      * Get the customer addresses
      * 
      * @param  boolean $isApi 
      * @return 
      */
     public function processGet($isApi = false)
     {
         if ($isApi) {
             $input = Request::all();
             $validator =$this->validator($input, $isApi, ['customer_id']);

             if ($validator->fails()) {
                 if ($isApi) {
                     return $validator->messages();
                 }
                 return Redirect::route('my-address')
           ->withErrors($validator);
             }
             return $this->getCustomerAddresses($input['customer_id']);
         }
     }

    /**
     * [getCustomerAddresses description]
     * @param  [type] $customerId [description]
     * @return [type]             [description]
     */
    public function getCustomerAddresses($customerId)
    {
        $customer = Customer::find($customerId);

        if ($customer != null) {
            $customerAddresses = $customer->addresses->flatten();
            return $customerAddresses->toArray();
        }
    }

     /**
      * Prepares the data array
      * 
      * @param  array $input
      * @return array $data 
      */
     public function prepareData($input, $customer_id = null)
     {
         $data['customer_id']  = ($customer_id != null)? $customer_id : Auth::user()->id;
         $data['name']         = $input['name'];
         $data['pincode']      = $input['pincode'];
         $data['phone']        = $input['mobile'];
         $data['address']      = $input['address'];
         $data['city']         = $input['city'];
         $data['state']        = $input['state'];
         $data['country']      = "India";
         if (isset($input['is_default'])) {
             $data['is_default']  = 1;
         }
         return $data;
     }

     /**
      * Store address data to db 
      * 
      * @param  array $data 
      * @param  bool  $isApi
      * 
      * @return \Illuminate\Routing\Redirector
      */
     public function storeAddressToDb($data, $isApi = false)
     {
         if (isset($data['is_default'])) {
             $this->checkAndResetDefaultAddress($data);
         }

         $result = AddressModel::firstOrCreate($data);

         if ($isApi == false) {
             if ($result) {
                 Flash::success('New Address Saved SuccessFully..');
                 return Redirect::route('my-address');
             }
             throw new AddressNotSaved();
         } else {
             if ($result) {
                 return true;
             }
             return false;
         }
     }

     /**
      * Update address data to db 
      * 
      * @param  array $data 
      * @param  bool  $isApi
      * 
      * @return \Illuminate\Routing\Redirector
      */
     public function updateAddressToDb($data, $isApi = false)
     {
         $address = AddressModel::where(['id' => $data['address_id'], 'customer_id' => $data['customer_id']])->get()->first();

         if ($address == null) {
             return ['error' => 'Unable to locate the address'];
         }

         $this->checkAndResetDefaultAddress($data);

         $address->name = $data['name'];
         $address->pincode = $data['pincode'];
         $address->address = $data['address'];
         $address->phone = $data['mobile'];
         $address->city = $data['city'];
         $address->state = $data['state'];

         if (isset($data['is_default'])) {
             $address->is_default = 1;
         }

         $result = $address->save();

         if ($isApi == false) {
             if ($result) {
                 Flash::success('Address Updated SuccessFully..');

                 if($data['is_request_from_cart_address_page'] == 1){
                    return Redirect::route('cart-address');
                 }

                 return Redirect::route('my-address');
             }else{
                Flash::error('Unable To Save New Address. Please Try Again Later .. ');
                
                if($data['is_request_from_cart_address_page'] == 1){
                    return Redirect::route('cart-address');
                }
               return Redirect::route('my-address');
             }
         } else {
             if ($result) {
                 return true;
             }
             return false;
         }
     }

    public function deleteAddress($data, $isApi)
    {
        $address = AddressModel::where(['id' => $data['address_id'], 'customer_id' => $data['customer_id']])->get()->first();

        if ($address == null) {
            // return ['error' => 'Unable to locate the address'];
      return false;
        }
        return $address->delete();
    }

    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator($input, $isApi = false, $fieldsRequired = [])
    {
        $rules = [
      'customer_id'    => 'required|integer',
      'address_id'     => 'required|integer',
      'name'           => 'required|min:4',
      'pincode'        => 'required|digits:6|integer',
      'mobile'         => 'required|digits:10',
      'address'        => 'required',
      'city'           => 'required|string',
      'state'          => 'required|string'
      ];

        if ($fieldsRequired != null) {
            $fieldsRequired = array_flip($fieldsRequired);
            $rules = array_intersect_key($rules, $fieldsRequired);
        }

        if ($isApi) {
            return Validator::make($input, $rules);
        }

        unset($rules['customer_id']);
        unset($rules['address_id']);

        return Validator::make($input, $rules);
    }

    protected function checkAndResetDefaultAddress($data)
    {
        $address = AddressModel::where(['customer_id' => $data['customer_id'], 'is_default' => 1])->get()->first();

        if ($address != null) {
            $address->is_default = 0;

            $address->save();

            return ;
        }
    }
}
