<?php namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Request;
use App\Acme\Transformers\AddressTransformer;
use App\Http\Controllers\Traits\Address as AddressTrait;
use App\Http\Controllers\Api\Contracts\Address as AddressContract;

class AddressController extends ApiController implements AddressContract
{
    use AddressTrait;

    /**
     * Add new address
     */
    public function add()
    {
        $result = $this->processStore(TRUE);

        if (is_bool($result)) {
            if ($result == false) {
                return $this->respond(['message' => 'Unable to add new address ', 'add_address' => 0]);
            }
            return $this->respond(['message' => 'Address Added Successfully', 'add_address' => 1]);
        }
        return $this->respondWithError($result);
    }

    /**
     * Get all customer address
     * 
     * @return json
     */
    public function get(AddressTransformer $transformer)
    {
    	$result = $this->processGet(TRUE);

    	if(is_array($result)){
	    	return $this->respond($transformer->TranformArray($result));
    	}
    	return $this->respondWithErrorithError($result);
    }

    /**
     * Update customer address
     * 
     * @return json
     */
    public function update()
    {
    	$result = $this->processUpdate(TRUE);

        if (is_bool($result)) {
            if ($result == false) {
                return $this->respond(['message' => 'Unable to update address ', 'update_address' => 0]);
            }
            return $this->respond(['message' => 'Address Updated Successfully', 'update_address' => 1]);
        }

        if(is_array($result)){
        	return $this->respond(['message' =>$result['error'], 'update_address' => 0]);
        }
        return $this->respondWithError($result);
    }

    /**
     * Delete customer address
     * 
     * @return json
     */
    public function delete()
    {
    	// customer id , address id 
    	$result = $this->processDelete(TRUE);

	    if (is_bool($result)) {
            if ($result == false) {
                return $this->respond(['message' => 'Unable to delete address ', 'delete_address' => 0]);
            }
            return $this->respond(['message' => 'Address deleted Successfully', 'delete_address' => 1]);
        }

        if(is_array($result)){
        	return $this->respond(['message' =>$result['error'], 'delete_address' => 0]);
        }
        return $this->respondWithError($result);
    }
}
