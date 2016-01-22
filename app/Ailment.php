<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ailment extends Model
{
    /**
     * Specifies the database table
     *
     * @var string
     **/
     protected $table="ailments";

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = ['ailment_name'];

    /**
     * An ailment belongs to many products (Products Here Means Medicines)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function products()
     {
        return $this->belongsToMany('App\Product','product_ailment')->withTimeStamps();
     }

	/**
     * An ailment belongs to many salts 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function salts()
     {
        return $this->belongsToMany('App\Salt','ailment_salt')->withTimeStamps();
     }

}
