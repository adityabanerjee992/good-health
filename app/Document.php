<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * Specifies the database table
     *
     * @var string
     **/
    protected $table = "documents";

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = [
     'order_id',
     'customer_id',
     'patient_name',
     'document_name',
     'prescription_date',
     'document_notes',
     'document_original_name',
     'document_type',
     'document_storage_path'
     ];
   }
