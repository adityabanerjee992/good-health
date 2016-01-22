<?php namespace App\Acme\Transformers;

class DocumentTransformer extends Transformer{
	
    public function transform($document)
    {
        return [
            'document_id' => $document['id'],
            'document_name' => $document['document_name'],
            'patient_name' => $document['patient_name'],
            'document_original_name' => $document['document_original_name'],
            'document_type' => $document['document_type'],
    		'document_notes'	=> $document['document_notes'],
    		'storage_path' => $document['document_storage_path'],
            'upload_date'    => $document['created_at'],
    		'prescription_date'    => $document['prescription_date'],
        ];
    }
}
?>