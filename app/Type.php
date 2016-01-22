<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
     /**
     * Specifies the database table
     *
     * @var string
     **/
     protected $table="types";

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = ['type_name'];
   	
     /**
     * A Product belongs to some manufacturer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function products()
     {
     	return $this->belongsToMany('App\Product','product_type')->withTimeStamps();
     }    
}
