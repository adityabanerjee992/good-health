<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * Specifies the database table
     *
     * @var string
     **/
     protected $table="companies";

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = ['company_name'];

    /**
     * A company has many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function products()
     {
     	 return $this->belongsToMany('App\Product','product_company')->withTimeStamps();
     }
}
