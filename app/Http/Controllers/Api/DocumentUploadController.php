<?php namespace App\Http\Controllers\Api;

use Auth;
use Request;
use Response;
use App\Http\Controllers\Controller;
use App\Http\Contracts\Order as Order;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Traits\DocumentUpload;
use App\Http\Controllers\Api\Contracts\DocumentUpload as DocumentUploadContract;

class DocumentUploadController extends ApiController implements DocumentUploadContract
{
    use DocumentUpload;
    
    /**
     * Order object used for communicating 
     * with the order interface or 
     * contract
     * 
     * @var \App\Http\Contracts\Order
     */
    protected $order;

	public function __construct(Order $order)
	{
        $this->setOrder($order);
	}

	public function store()
	{
        $input = Request::all();
        $validator = $this->validatorForDocument($input);
        // dd($validator);
        if($validator->fails()){
            return $this->respond(['status' => 0 , 'message' => $validator->messages()]);
        }

        $orderId= $this->getOrder()->getOrderId($input['customer_id']);
        // dd($orderId);
        $dest = base_path().'/storage/app/customer/'.$input['customer_id'].'/prescriptions';
        $dest1 ='/customer/'.$input['customer_id'].'/prescriptions/';
        $documentType = "prescription";

        if($this->processFileStore($input, $orderId, $dest1, $documentType,true)){
            return $this->respond(['status'=> 1,'message' => 'Prescription Uploaded Successfully']);
        }
        return $this->respond(['status'=> 0, 'message' => 'Unable To Uploaded Prescription']);
    }

    // public function getAllDocuments()
    // {
    //     $input = Request::all();
        
    //     if($input['customer_id'] == NULL){
    //         $this->respond(['status' => 0 , 'message' => 'No Customer id provided ..']);
    //     }

    //     $customer = Customer::find($input['customer_id']);
    //     $documents = $customer->documents;

    //     dd($documents);
    // }
    
    // public function getMedicalDocuments()
    // {

    // }

    /**
     * Gets the Order object used for communicating
     * with the order interface or
     * contract.
     *
     * @return \App\Http\Contracts\Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Sets the Order object used for communicating 
     * with the order interface or
     * contract.
     *
     * @param \App\Http\Contracts\Order $order the order
     *
     * @return self
     */
    protected function setOrder(\App\Http\Contracts\Order $order)
    {
        $this->order = $order;

        return $this;
    }
}