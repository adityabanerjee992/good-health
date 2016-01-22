<?php

namespace App\Http\Contracts;

interface DocumentUpload
{
    /**
     * Store file or document to the storage (It can be amazon s3 or local storage ).
     * 
     * @param   array   $input
     * @param   integer $orderId
     * @param   string  $destination
     * @param   string  $documentType
     *
     * @return  boolean
     */
    public function store($input,$orderId,$destination,$documentType);


    /**
     *  Get the file or document from the storage (It can be amazon s3 or local storage ).
     * 
     * @param   integer  $documentId
     *
     * @return  file
     */
    public function get($documentId);
}