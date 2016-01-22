<?php namespace App\Http\Controllers\Api;

use Auth;
use Response;
use App\Customer;
use App\User as User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Order ;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Api\ApiController;
use App\Acme\Transformers\AddressTransformer; 
use App\Acme\Transformers\DocumentTransformer;
use App\Acme\Transformers\UserAccountInformationTransformer;
use App\Http\Controllers\Api\Contracts\UserAccount as UserAccountContract;

class UserAccountController extends ApiController implements UserAccountContract
{
    use order;
    /**
     * 
     * @var DocumentTransformer
     */
    protected $documentTransformer;

    /**
     * 
     * @var AddressTransformer
     */
    protected $addressTransformer;   

     /**
     * 
     * @var AddressTransformer
     */
    protected $userAccountInformationTransformer;

    public function __construct(DocumentTransformer $documentTransformer, 
                                AddressTransformer $addressTransformer,
                                UserAccountInformationTransformer $userAccountInformationTransformer)
    {
        $this->setDocumentTransformer($documentTransformer);
        $this->setAddressTransformer($addressTransformer);
        $this->setUserAccountInformationTransformer($userAccountInformationTransformer);
    }

    /**
     * Get user documents
     * 
     * @return json
     */
    public function userDocuments()
    {
        $input = Request::all();

        if($input['customer_id'] == NULL){
           $this->respondWithError('No Customer id provided..');
        }

        $customer = Customer::find($input['customer_id']);

        if (is_null($customer)) {
            return $this-returnNotFound('Customer not found');
        }

        $documents = $customer->documents->toArray();
        // dd($documents);
        return $this->respond($this->getDocumentTransformer()->tranformArray($documents));
    }

    /**
     * Get user address
     * @return json
     */
    public function userAddress()
    {
        if (Auth::Check()) {
            $user = User::find(Auth::user()->id);
    
            if (is_null($user)) {
                return $this-returnNotFound('User Not Found');
            }

            $userAddresses = $user->addresses->toArray();

            return $this->respond($this->getAddressTransformer()->tranformArray($userAddresses));
        } else {
            return $this->respondWithError('User needs to be looged in');
        }
    }

    public function userAccountInformation()
    {
        $input = Request::all();

        if($input['customer_id'] != NULL){
            $customer = Customer::find($input['customer_id'])->toArray();
            // dd($customer);
            return $this->respond($this->getUserAccountInformationTransformer()->transform($customer));
        }

        $this->respond(['status' => 0 ,'message' => 'Customer id is empty']);
    }

    public function updateUserAccountInformation()
    {
        $input = Request::all();
  
        $typeOff = 'account_info';

        $validator = $this->validator($input, $typeOff);

        if($validator->fails()){
            $this->respond(['status' => 0 , 'message' => $validator->messages()]);
        }   

        if($input['customer_id'] == NULL){
            $this->respond(['status' => 0 , 'message' =>'Customer id is not provided']);
        }

        //else process the update request ..
        $updateResult = $this->updateUserAccountInfo($input,true);

        if($updateResult){
            return $this->respond(['status' => 1 ,'message' => 'Account Information Updated']);
        }
    }

   public function changePassword()
    {
        $input = Request::all();
  
        $typeOff = 'change_password';

        $validator = $this->validator($input, $typeOff);
        if($validator->fails()){
            return $this->respond(['status' => 0 , 'message' => $validator->messages()]);
        }   

        if($input['customer_id'] == NULL){
            $this->respond(['status' => 0 , 'message' =>'Customer id is not provided']);
        }
        //else process the update request ..
        $updateResult = $this->changeUserAccountPassword($input,true);

        if($updateResult == 1){
            return $this->respond(['status' => 1 ,'message' => 'Account Password Changed Successfully..']);
        }elseif ($updateResult == 2) {
            return $this->respond(['status' => 0 ,'message' => 'Unable to change the password . please try again']);
        }else{
            return $this->respond(['status' => 0 ,'message' => ['current_password' => 'Your Passwordrovided Current Password Is Incorrect.']]);
        }
    }

    /**
     * Gets the value of documentTransformer.
     *
     * @return Acme\Transformers\DocumentTransformer
     */
    public function getDocumentTransformer()
    {
        return $this->documentTransformer;
    }

    /**
     * Sets the value of documentTransformer.
     *
     * @param DocumentTransformer $documentTransformer the document transformer
     *
     * @return self
     */
    protected function setDocumentTransformer(DocumentTransformer $documentTransformer)
    {
        $this->documentTransformer = $documentTransformer;

        return $this;
    }

    /**
     * Gets the value of addressTransformer.
     *
     * @return AddressTransformer
     */
    public function getAddressTransformer()
    {
        return $this->addressTransformer;
    }

    /**
     * Sets the value of addressTransformer.
     *
     * @param AddressTransformer $addressTransformer the address transformer
     *
     * @return self
     */
    protected function setAddressTransformer(AddressTransformer $addressTransformer)
    {
        $this->addressTransformer = $addressTransformer;

        return $this;
    }

    /**
     * Gets the value of userAccountInformationTransformer.
     *
     * @return AddressTransformer
     */
    public function getUserAccountInformationTransformer()
    {
        return $this->userAccountInformationTransformer;
    }

    /**
     * Sets the value of userAccountInformationTransformer.
     *
     * @param AddressTransformer $userAccountInformationTransformer the user account information transformer
     *
     * @return self
     */
    protected function setUserAccountInformationTransformer(UserAccountInformationTransformer $userAccountInformationTransformer)
    {
        $this->userAccountInformationTransformer = $userAccountInformationTransformer;

        return $this;
    }
}
