<?php namespace App\Http\Controllers\Traits;

use Storage;
use App\Document;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\FileNotSaved as FileNotSaved;
use App\Exceptions\FileNotFound as FileNotFound;

trait DocumentUpload
{
    public function getDocument($documentId)
    {
        $document = Document::find($documentId);

        if ($document != null) {
            $fileName = $document->document_original_name;
            $filePath = $document->document_storage_path;

            $file = $filePath . $fileName;

            $s3 = \Storage::disk('s3');

            if ($s3->exists($file)) {
                $contents = $s3->get($file);

                $mimetype = $s3->mimeType($file);

                return response($contents)
                            ->header('Content-Type', $mimetype);
            }

            throw new FileNotFound();
        }
        throw new FileNotFound();
    }
    /**
     * Process the file store (document) to the storage.
     * 
     * @param   array   $input
     * @param   integer $orderId
     * @param   string  $destination
     * @param   string  $documentType
     *        
     * @return  boolean
     */
    public function processFileStore($input, $orderId, $destination, $documentType, $isApi = false)
    {
        if ($this->checkIfPrescriptionExistsForSameOrderId($orderId)) {
            if ($this->detachExistingPrescription($orderId) == false) {
                return false;
            }
        }

        $file = $input['prescription_file'];
        $addPrefixToFile = 'gh_'.uniqid();
        
        if($this->uploadFileToStorage($file,$destination))
        {
            return $this->storeFileRecordToDb($input, $orderId, $destination, $documentType, $isApi);
        }

        if ($isApi) {
            return false;
        }

        throw new FileNotSaved();
    }

    public function checkIfPrescriptionExistsForSameOrderId($orderId)
    {
        $documents = \App\Document::where(['order_id' => $orderId])->get();

        if ($documents->count() != 0) {
            return true;
        }
        return false;
    }

    public function detachExistingPrescription($orderId)
    {
        $document = \App\Document::where(['order_id' => $orderId])->get();

        $document = $document->first();

        DB::beginTransaction();

        $document->order_id = null;

        if ($document->save()) {
            DB::commit();
            return true;
        }
        
        // $filePath = $document->document_storage_path.$document->document_original_name;

        // if ($document->delete()) {
        //     if ($this->deleteFileFromStorage($filePath)) {
        //         DB::commit();
        //         return true;
        //     }
        // }
        DB::rollBack();
        return false;
    }

    /**
     * Creates a db entry of the file 
     * uploaded
     * 
     * @param   array   $file
     * @param   integer $orderId
     * @param   string  $destination
     * @param   string  $documentType
     *        
     * @return  boolean
     */
    public function storeFileRecordToDb($input, $orderId, $destination, $documentType, $isApi = false)
    {
        $file = $input['prescription_file'];
        $document = new Document;
        $document->order_id = $orderId;
        $document->customer_id = ($isApi)? $input['customer_id'] : Auth::user()->id;
        $document->document_name = $input['document_name'];
        $document->document_original_name = $file->getClientOriginalName();
        // This is temporary needs to change it 
        // once the upload prescription form is changed ..
        $document->patient_name = $input['patient_name'];
        $document->prescription_date =date("Y-m-d", strtotime($input['prescription_date']));
        $document->document_notes = $input['notes'];

        $document->document_type = $documentType;
        $document->document_storage_path = $destination;

        if ($document->save()) {
            return true;
        } else {
            $filePath = $destination.$file->getClientOriginalName();
            $this->deleteFileFromStorage($filePath);
            
            if ($isApi) {
                return false;
            }

            throw new FileNotSaved();
        }
    }

    /**
     * Upload the file to S3 Storage
     * 
     * @param   file    $file
     * @param   string  $destination
     * @return  boolean
     */
    public function uploadFileToStorage($file, $destination)
    {
       $s3 = \Storage::disk('s3');
        $fileName = $file->getClientOriginalName();
        $filePath = $destination.$fileName;
        
        if ($s3->put($filePath, file_get_contents($file))) {
            return true;
        }
        return false;
    }

    /**
     * Delete the file from S3 Storage
     * 
     * @param   string    $fileName
     * @param   string  $destination
     * @return  boolean
     */
    public function deleteFileFromStorage($filePath)
    {
        $s3 = \Storage::disk('s3');

        if ($s3->delete($filePath)) {
            return true;
        }
        return false;
    }

    public function getEditDocument($documentId, Request $request)
    {
        if ($request->path() == 'my-account/my-order-details/'.$documentId.'/edit-doc') {
            $isRequestFromOrderDetailsPage = 1;
        } else {
            $isRequestFromOrderDetailsPage = 0;
        }

        $customerId = Auth::user()->id;
        $document = Document::where(['id' => $documentId, 'customer_id' => $customerId])->get();
        
        if (!$document->isEmpty()) {
            $document = $document->first();
            return view('myaccounts.edit-prescription', compact('document', 'isRequestFromOrderDetailsPage'));
        }

        Flash::error('Unable to locate the document..');
        return Redirect::back();
    }

    public function postEditDocument(Request $request, $documentId, $isApi = false)
    {
        // dd($request->url());

        $input = $request->all();

        $validator = $this->validatorForDocument($input);

        if ($validator->fails()) {
            if ($isApi) {
                //return some code that needs to ne figured out ..
            }
            return Redirect::back()->withErrors($validator);
        }

        //checks 
        // 1) Check if document belogs to the current looged in user ..

        $customerId = ($isApi) ? $input['customer_id'] : \Auth::user()->id;

        if ($this->documentBelongsToCustomer($documentId, $customerId)) {
            if ($this->processEdit($input, $documentId)) {

                //this thing needs to be done .. pending for now ..
                // if($input['isRequestFromOrderDetailsPage'] == 1){
                //    // change the order status to confirmed back ..
                //    // fire an event to udpate the chemist that prescription has been 
                //    // updated by the user ..
                //    Event::fire(new ChemistAccountCreated($user->first_name.' '.$user->last_name,$user->email,$user->password));
                //    Event::fire(new CustomerUpdatedThePrescription());

                // }

                Flash::success('Document Updated Successfully .. ');
                return (isset($input['back_url']) and $input['back_url'] != null) ? Redirect::to($input['back_url']) : Redirect::back();
            }
        }

        Flash::error('You are trying to perform an invalid operation..');
        return Redirect::back();
    }

    protected function documentBelongsToCustomer($documentId, $customerId)
    {
        $document = \App\Document::where(['id' => $documentId, 'customer_id' => $customerId])->get();

        if ($document->count() != 0) {
            return true;
        }
        return false;
    }

    protected function processEdit($input, $documentId)
    {
        //get the document by its id 
        // edit the doc nd save it and return back ..

        $document = \App\Document::find($documentId);

        DB::beginTransaction();

        if ($document != null) {
            $filePath = $document->document_storage_path.$document->document_original_name;
            $file = $input['prescription_file'];
            $destination = $document->document_storage_path;

            //unlink the previous prescription from the s3 storage ..
            if ($this->deleteFileFromStorage($filePath) == false) {
                return false;
            }

            if ($this->uploadFileToStorage($file, $destination) == false) {
                return false;
            }

            //uniqid("gh",true);
            $document->document_name = $input['document_name'];
            $document->document_original_name = $file->getClientOriginalName();

            $document->patient_name = $input['patient_name'];
            $document->prescription_date =date("Y-m-d", strtotime($input['prescription_date']));
            $document->document_notes = $input['notes'];

            if ($document->save()) {
                DB::commit();
                return true;
            }
        }

        DB::rollBack();
        return false;
    }
    public function postDeleteDocument(Request $request, $isApi = false)
    {
        $input = $request->all();

        if ($request->ajax()) {
            if ($this->ifDocumentIsLinkedWithAnyOrder($input['document_id'])) {
                return response(['status' => 0,
                           'message'=>'The prescription which you are trying to delete is used in one of your orders . Unable to delete the prescription..']);
            }

            if ($this->deleteDocument($input, $isApi)) {
                return response(['status' => 1, 'message' => 'Document Deleted Successfully']);
            }
        } else {
            // $customer_id = null;

            // $validator =$this->validator($input, $isApi, ['customer_id', 'address_id']);

            // if ($validator->fails()) {
            //     if ($isApi) {
            //         return $validator->messages();
            //     }
            //     return Redirect::route('my-address')
            //              ->withErrors($validator);
            // } else {
            //     return $this->deleteAddress($input, $isApi);
            // }
        }
    }

    protected function ifDocumentIsLinkedWithAnyOrder($documentId)
    {
        $document = \App\Document::find($documentId);

        if ($document != null) {
            if ($document->order_id != null) {
                return true;
            }
        }
        return false;
    }

    public function deleteDocument($data, $isApi=false)
    {
        $document = \App\Document::where(['id' => $data['document_id']])->get()->first();

        if ($document == null) {
            // return ['error' => 'Unable to locate the document'];
            return false;
        }
        return $document->delete();
    }


    protected function validatorForDocument($input)
    {
        return Validator::make($input, [
            'patient_name' => 'required',
            'document_name' => 'required',
            'prescription_date' => 'required|date',
            'notes' => 'required',
            'prescription_file' => 'required|mimes:jpeg,png|max:1000',
        ]);
    }
}
