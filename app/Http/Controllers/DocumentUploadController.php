<?php namespace App\Http\Controllers;

use Auth;
use Storage;
use App\Document as Document;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\DocumentUpload;
use App\Http\Contracts\DocumentUpload as DocumentUploadContract;

class DocumentUploadController extends Controller implements DocumentUploadContract
{
    use DocumentUpload;
    
    /**
     * Store file (document) to the storage.
     * 
     * @param   array   $input
     * @param   integer $orderId
     * @param   string  $destination
     * @param   string  $documentType
     *        
     * @return  boolean
     */
    public function store($input,$orderId,$destination,$documentType)
    {
        return $this->processFileStore($input,$orderId,$destination,$documentType);
    }

    /**
     *  Get the file or document from the storage (It can be amazon s3 or local storage ).
     * 
     * @param   integer  $documentId
     *
     * @return  file
     */
    public function get($documentId)
    {
     return $this->getDocument($documentId);
    }
}
