<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
   /**
     * Specifies the database table
     *
     * @var string
     **/
     protected $table="pincodes";

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = [
                            'pincode'
                           ];

    public static function ifPincodeExist($pincodes,$id = NULL)
    {
    	$pincodes = explode(',', $pincodes);

    	foreach ($pincodes as $pincode) {
    		$pincode = static::where(['pincode' => $pincode])->get();
			
			if($pincode->isEmpty()){
				continue;
			}    		
			
    		$stores = $pincode->first()->stores;

    		if($stores->isEmpty()){
    			continue ;
    		}

    		if($id != NULL){
    			if($stores->first()->id == $id){
    				continue;
    			}	
    		}
    		return $pincode->first();
     	}
     	return NULL;
    }

    /**
     * A pincode can have many stores
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function stores()
     {
        return $this->belongsToMany('App\Store','store_pincode')->withTimeStamps();
     } 
}
