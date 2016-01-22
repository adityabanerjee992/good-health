<?php namespace App\Http\Controllers\Admin;

use App\Order;
use App\Customer;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use App\Events\CustomerAccountActivated;
use App\Events\CustomerAccountSuspended;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Admin\JoshController;

class CustomerController extends BaseController
{
    /**
     * Declare the rules for the form validation
     *
     * @var array
     */
    protected $validationRules = array(
        'first_name'       => 'required|min:3',
        'last_name'        => 'required|min:3',
        'email'            => 'required|email|unique:users',
        'password'         => 'required|between:3,32',
        'password_confirm' => 'required|same:password',
        'pic' => 'mimes:jpg,jpeg,bmp,png|max:10000'
    );
    
    /**
     * Show a list of all the customers.
     *
     * @return View
     */
    public function getIndex()
    {
        // Grab all the customers
        $customers = Customer::All();

        // $customer = Customer::onlyTrashed();

        // $customer->restore();

        // Show the page
        return View('admin.customers.index', compact('customers'));
    }

    /**
     * Create new user
     *
     * @return View
     */
    public function getCreate()
    {
        // Get all the available groups
        $groups = Sentinel::getRoleRepository()->all();

        // Show the page
        return View('admin/users/create',compact('groups'));
    }
    
    /**
     * User create form processing.
     *
     * @return Redirect
     */
    public function postCreate()
    {
        // Declare the rules for the form validation
        $rules = array(
            'first_name'       => 'required|min:3',
            'last_name'        => 'required|min:3',
            'email'            => 'required|email|unique:users',
            'password'         => 'required|between:3,32',
            'password_confirm' => 'required|same:password',
            'group'            => 'required|numeric',
            'pic'              => 'mimes:jpg,jpeg,bmp,png|max:10000'
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        //upload image
        if ($file = Input::file('pic'))
        {
            $fileName        = $file->getClientOriginalName();
            $extension       = $file->getClientOriginalExtension() ?: 'png';
            $folderName      = '/uploads/users/';
            $destinationPath = public_path() . $folderName;
            $safeName        = str_random(10).'.'.$extension;
            $file->move($destinationPath, $safeName);
        }

        //check whether use should be activated by default or not
        $activate = Input::get('activate')?true:false;

        try {
            // Register the user
            $user = Sentinel::register(array(
                'first_name' => Input::get('first_name'),
                'last_name'  => Input::get('last_name'),
                'email'      => Input::get('email'),
                'password'   => Input::get('password'),
                'dob'   => Input::get('dob'),
                'bio'   => Input::get('bio'),
                'pic'   => isset($safeName)?$safeName:'',
                'gender'   => Input::get('gender'),
                'country'   => Input::get('country'),
                'state'   => Input::get('state'),
                'city'   => Input::get('city'),
                'address'   => Input::get('address'),
                'postal'   => Input::get('postal'),
            ),$activate);

            //add user to 'User' group
            $role = Sentinel::findRoleById(Input::get('group'));
            $role->users()->attach($user);

            //check for activation and send activation mail if not activated by default
            if(!Input::get('activate')) {
                // Data to be used on the email view
                $data = array(
                    'user'          => $user,
                    'activationUrl' => URL::route('activate', $user->id, Activation::create($user)->code),
                );

                // Send the activation code through email
                Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                    $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                    $m->subject('Welcome ' . $user->first_name);
                });
            }

            // Redirect to the home page with success menu
            return Redirect::route("users")->with('success', Lang::get('users/message.success.create'));

        } catch (LoginRequiredException $e) {
            $error = Lang::get('admin/users/message.user_login_required');
        } catch (PasswordRequiredException $e) {
            $error = Lang::get('admin/users/message.user_password_required');
        } catch (UserExistsException $e) {
            $error = Lang::get('admin/users/message.user_exists');
        }

        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * User update.
     *
     * @param  int  $id
     * @return View
     */
    public function getEdit($id)
    {
        $customer = Customer::find($id);
        return view('admin.customers.edit',compact('customer'));
    }

    /**
     * User update form processing page.
     *
     * @param  int      $id
     * @return Redirect
     */
    public function postEdit(Request $request,$id)
    {
        $input = $request->all();
        $customer = Customer::find($id);

        $oldAccountStatus = $customer->account_status;
        
        $customer->name = $input['customer_name'];
        $customer->gender = $input['gender'];
        $customer->account_status = $input['account_status'];
        
        if($customer->save())
        {
            return $this->checkAccountStatus($input['account_status'],$oldAccountStatus,$customer);
        }

        Flash::error('Unable to update user .. please try again ..');
        return Redirect::to(route('customers-edit',$id));
    }

    protected function checkAccountStatus($accountStatus,$oldAccountStatus,$customer)
    {
        if($accountStatus != $oldAccountStatus){
            if($accountStatus == 1){
                //fire event for account activated
                Event::fire(new CustomerAccountActivated($customer->email,$customer->name));
            }
            else{
                //fire event for account suspended            
                Event::fire(new CustomerAccountSuspended($customer->email,$customer->name));
            }

            Flash::success('Customer Data Updated SuccessFully');
            return Redirect::to(route('customers-edit',$customer->id));
        }
        Flash::success('Customer Data Updated SuccessFully');
        return Redirect::to(route('customers-edit',$customer->id));
    }

    /**
     * Show a list of all the deleted users.
     *
     * @return View
     */
    public function getDeletedCustomers()
    {
    	// return view('admin.index');
        // Grab deleted users
        $customers = Customer::onlyTrashed()->get();

        // Show the page
        return View('admin.customers.deleted-customers', compact('customers'));
    }


    /**
     * Delete Confirm
     *
     * @param   int   $id
     * @return  View
     */
    public function getModalDelete($id = null)
    {
    	$modalTitle = 'Delete Customer';
        $error = NULL;

        if(Order::anyCustomerOrderExist($id)){
            $error = 'Sorry ! You can\'t delete this customer because this customer has some orders';
        }
        else{
            $modalBody = 'Are you sure you want to delete this product .. ? .Once deleted cannot be reverted back..';
        }
    
        $Customer = Customer::find($id);
        
        if($Customer != NULL){
            $confirm_route = route('delete-customers',['id' => $Customer->id]);
            return view('admin/layouts/modal_confirmation_new', compact('modalTitle', 'modalBody', 'confirm_route','error','id'));
        }
        $error = 'Customer Not Found';
        $confirm_route = route('delete-customers',['id' => $Customer->id]);
        return view('admin/layouts/modal_confirmation_new', compact('modalTitle', 'modalBody', 'confirm_route','error'));
    }

    public function destroy($id)
    {
      $customer = Customer::find($id);

      if($customer->delete())
      {
         Flash::success('Hooray !! . Customer Deleted SuccessFully ..');
                return Redirect::to(route('customers')); 
      }
       Flash::error('Unable to delete the customer .. Please try again .');
                return Redirect::to(route('customers')); 
    }

    /**
     * Restore a deleted customer.
     *
     * @param  int      $id
     * @return Redirect
     */
    public function getRestore($id)
    {
        $customer = Customer::onlyTrashed()->where(['id' => $id])->get();

        if(!$customer->isEmpty()){

            $customer[0]->restore();

            Flash::success('Customer Restored SuccessFully..!!');
            return Redirect::to(route('customers'));
        }
        Flash::error('Customer Not Found ');
        return Redirect::to(route('deleted-customers'));
    }

    /**
     * Display specified user profile.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        return view('admin.customers.show',compact('customer'));
    }

    /**
     * Get user access state
     *
     * @return View
     */
    public function getUserAccess()
    {
        if (Sentinel::getUser()->inRole('admin')) {

            $userAccess = "admin";
        }
        else {
            $userAccess = "others";
        }

        // Show the page
        return View('admin/groups/any_user', compact('userAccess'));
    }

    /**
     * Show View or redirect to 404
     *
     * @return View
     */
    public function getAdminOnlyAccess()
    {
        if (Sentinel::getUser()->inRole('admin')) {

            return View('admin/groups/admin_only');
        }
        else {
            return View('admin/404');
        }

        // fallback
        return View('admin/404');
    }

}
