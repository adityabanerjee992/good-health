<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    /**
     * Specifies the database table
     *
     * @var string
     **/
     protected $table="class";

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = ['class_name'];


	/**
     * A class has many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function products()
     {
     	$this->hasMany('App\Product');
     }

     /**
     * A class belongs to or can have many salts 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function salts()
     {
        return $this->belongsToMany('App\Salt','classes_salt')->withTimeStamps();
     }
}
