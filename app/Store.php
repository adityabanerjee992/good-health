<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
	use SoftDeletes;
    
    /**
     * Specifies the database table
     *
     * @var string
     **/
     protected $table="stores";

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = [
                            'name',
                            'user_id',
                            'owner_name',
                            'address',
                            'city',
                            'state',
                            'country',
                            'primary_mobile_number',
                            'alternate_mobile_number',
                            'email'
                           ];
                           
    /**
     * A store can have many pincodes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function pincodes()
     {
        return $this->belongsToMany('App\Pincode','store_pincode')->withTimeStamps();
     }

    /**
     * Get the user associated with the store.
     */
    public function user()
    {
        return $this->hasOne('App\store','user_id');
    } 
    
    /**
     * Get the store id by uid
     * 
     * @param  int $userId 
     * @return int        
     */
    public static function getStoreIdByUid($userId)
    {
       $store = static::where('user_id',$userId)->get()->first();

       if($store != NULL){
        return $store->id;
       }
       return NULL;
    }
}

