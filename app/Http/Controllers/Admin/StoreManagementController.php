<?php namespace App\Http\Controllers\Admin;

use App\Store;
use App\Pincode;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\ChemistAccountCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Controllers\Admin\Contracts\StoreManagement as StoreManagementContract;

class StoreManagementController extends BaseController implements StoreManagementContract
{
    /**
     * Display a listing of the stores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        return view('admin.medical-store.index',compact('stores'));
    }

    /**
     * Show the form for creating a new store.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.medical-store.create');
    }

   /**
     * Store a newly created store in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        $validator = $this->validator($input,true);

        if($validator->fails()){
          return Redirect::route('create-new-store')
            ->withErrors($validator)->withInput();
        }  
        
        $resultPincode = Pincode::ifPincodeExist($input['store_pincode']);
        if($resultPincode != NULL){
           Flash::error('Store with the pincode : '.$resultPincode->pincode.' already exists . 
                        Currently we do not allow multiple stores for same pincode');
           return Redirect::route('store-show',$resultPincode->id);
        }

        if($this->processStore($input)){
          Flash::success('New Store Added Successfully ..!!');
          return Redirect::route('all-stores');
        }
        Flash::error('Unable To Add New Store Please Try Again ..!!');
        return Redirect::route('all-stores');
    }

    /**
     * Display the specified store.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = Store::find($id);
        $pincodes = $this->getPincodesForView($store);
        
        if($store != NULL){
            return view('admin.medical-store.show',compact('store','pincodes'));
        }

        Flash::error('Unable to find the store');
        return Redirect::route('all-stores');
    }

    /**
     * Show the form for editing the specified store.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::find($id);

        $pincodes = $this->getPincodesForView($store);

        if($store != NULL){
            return view('admin.medical-store.edit',compact('store','pincodes'));
        }

        Flash::error('Unable to find the store');
        return Redirect::route('all-stores');
    }

    /**
     * Update the specified store in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = $this->validator($input);
        
        if($validator->fails()){
             return Redirect::to(route('store-edit',$id))->withInput()
                ->withErrors($validator);
        }  
   
        $resultPincode = Pincode::ifPincodeExist($input['store_pincode'],$id);
        if($resultPincode != NULL){
           Flash::error('Store with the pincode : '.$resultPincode->pincode.' already exists . 
                        Currently we do not allow multiple stores for same pincode');
           $stores = $resultPincode->stores;

           return Redirect::route('store-show',$stores->first()->id);
        }
        
        if($this->processEdit($input,$id)){
          Flash::success('Store Updated Successfully ..!!');
          return Redirect::route('all-stores');
        }
        Flash::error('Unable To Update Store Please Try Again ..!!');
        return Redirect::route('all-stores');
    }

    /**
     * Remove the specified store from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function destroy($id)
    {
         $store =Store::find($id);
          if($store->delete())
          {
             Flash::success('Hooray !! . Store Deleted SuccessFully ..');
                    return Redirect::to(route('all-stores')); 
          }
           Flash::error('Unable to delete the store .. Please try again .');
                    return Redirect::to(route('all-stores')); 
    }

    /**
     * Delete Confirm
     *
     * @param   int   $id
     * @return  View
     */
    public function getModalDelete($id = null)
    {
        $modalTitle = 'Delete Store';
        $modalBody = 'Are you sure you want to delete this store .. ? .Once deleted cannot be reverted back..';
        $error = NULL;

        $store = Store::find($id);
        
        if($store != NULL){
            $confirm_route = route('delete-store',['id' => $store->id]);
            return view('admin/layouts/modal_confirmation_new', compact('modalTitle', 'modalBody', 'confirm_route','error','id'));
        }
        $error = 'Store Not Found';
        $confirm_route = route('delete-store',['id' => $store->id]);
        return view('admin/layouts/modal_confirmation_new', compact('modalTitle', 'modalBody', 'confirm_route','error'));
    }

    /**
     * Show a list of all the deleted stores.
     *
     * @return View
     */
    public function getDeletedStores()
    {
        $stores = Store::onlyTrashed()->get();

        // Show the page
        return View('admin.medical-store.deleted-stores', compact('stores'));
    }

    /**
     * Restore a deleted store.
     *
     * @param  int      $id
     * @return Redirect
     */
    public function getRestore($id)
    {
        $store = Store::onlyTrashed()->where(['id' => $id])->get();

        if(!$store->isEmpty()){

            $store->first()->restore();

            Flash::success('Store Restored SuccessFully..!!');
            return Redirect::to(route('all-stores'));
        }
        Flash::error('Store Not Found ');
        return Redirect::to(route('deleted-stores'));
    }

    /**
     * Validator for store
     * 
     * @param array $input 
     */
    protected function Validator($input,$isCreate = False)
    {
        if($isCreate)
        {
            $rules = [
                'store_name' => 'required',
                'store_owner_name' => 'required',
                'store_address' => 'required',
                'store_city' => 'required',
                'store_state' => 'required',
                // 'store_pincode' => 'required|regex:[^\d(?:,\d)*$]',
                'store_pincode' => 'required',
                'primary_mobile_number' => 'required|digits:10|integer',
                'alternate_mobile_number' => 'digits:10|integer',
                'store_email_id' => 'required|email',
                'first_name'       => 'required|min:3',
                'last_name'        => 'required|min:3',
                'email'            => 'required|email|unique:users',
                'password'         => 'required|between:3,32',
                'password_confirm' => 'required|same:password'
            ];
            
        }else{
            $rules = [
                'store_name' => 'required',
                'store_owner_name' => 'required',
                'store_address' => 'required',
                'store_city' => 'required',
                'store_state' => 'required',
                'store_pincode' => 'required',
                'primary_mobile_number' => 'required|digits:10|integer',
                'alternate_mobile_number' => 'digits:10|integer',
                'store_email_id' => 'required|email'
            ];
        }
        return Validator::make($input,$rules);
    }

    /**
     * Process the creation of new store 
     * 
     * @param  array  $input 
     * @return bool 
     */
    protected function processStore($input)
    {   
        DB::beginTransaction();
        $user = $this->createStoreUser($input);

        if($user != NULL){

            $input['user_id'] = $user->id;

            $data = $this->getDataArray($input);

            $store = Store::firstOrCreate($data) ;

            if($store != NULL){    
                if($this->attachPincodes($input['store_pincode'],$store) == true){
                  DB::commit();
                  Event::fire(new ChemistAccountCreated($user->first_name.' '.$user->last_name,$user->email,$user->password));
                  return true;
                }
            }        
        }
        DB::rollBack();
        return false;
    }

    /**
     * Process the edit request for store.
     * 
     * @param  array  $input 
     * @param  int    $id    
     * @return bool       
     */
    protected function processEdit($input,$id)
    {
        $store = Store::find($id);

        $store->country = 'India';
        $store->city = $input['store_city'];
        $store->name = $input['store_name'];
        $store->state = $input['store_state'];
        $store->email = $input['store_email_id'];
        $store->address = $input['store_address'];
        $store->owner_name = $input['store_owner_name'];
        $store->primary_mobile_number = $input['primary_mobile_number'];
        $store->alternate_mobile_number = $input['alternate_mobile_number'];

        DB::beginTransaction();

        if($store->save()){
            //detach all pincodes
            $store->pincodes()->detach();

            if($this->attachPincodes($input['store_pincode'],$store) == true){
              DB::commit();
              return true;
            }
        }
        DB::rollBack();
        return false;
    }

    /**
     * Return the data arrray for store
     * 
     * @param  array $input 
     * @return array $data 
     */
    protected function getDataArray($input)
    {
        $data = [];

        $data['country'] = 'India';
        $data['city'] = $input['store_city'];
        $data['user_id'] = $input['user_id'];
        $data['name'] = $input['store_name'];
        $data['state'] = $input['store_state'];
        $data['email'] = $input['store_email_id'];
        $data['address'] = $input['store_address'];
        $data['owner_name'] = $input['store_owner_name'];
        $data['primary_mobile_number'] = $input['primary_mobile_number'];
        $data['alternate_mobile_number'] = $input['alternate_mobile_number'];

        return $data;
    }

    protected function attachPincodes($pincodes,$store)
    {
        $pincodes = explode(',', $pincodes);

        foreach ($pincodes as $pincode) {
            
            $pincodeData = ['pincode' =>$pincode];

            $pincode = Pincode::firstOrCreate($pincodeData);

            $store->pincodes()->attach($pincode->id);
        }   
        return true;
    }

    protected function getPincodesForView($store)
    {
        $pincodes = $store->pincodes;
        $pincodesStr = NULL;

        if(!$pincodes->isEmpty()){
            
            foreach ($pincodes as $pincode) {
                $pincodesStr .= $pincode->pincode .',';
            }
        }
        return trim($pincodesStr,',');
    }

    protected function createStoreUser($input)
    {
        //check whether use should be activated by default or not
        $activate = true;

        // Register the user
        $user = Sentinel::register(array(
            'first_name' =>$input['first_name'],
            'last_name'  =>$input['last_name'],
            'email'      =>$input['email'],
            'password'   =>$input['password'],
            'is_chemist_user' => true
        ),$activate);

        //add user to 'User' group
        $role = Sentinel::findRoleBySlug('chemist');
        $role->users()->attach($user);  
        return $user;
    }
}
