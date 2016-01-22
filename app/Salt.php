<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salt extends Model
{
    /**
     * Specifies the database table
     *
     * @var string
     **/
     protected $table="salts";

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = ['salt_name','salt_indications','salt_dose','salt_contraindications','salt_precautions','salt_adverse_effects','salt_storage'];

    /**
     * A salt has many products 
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function products()
     {
        return $this->belongsToMany('App\Product','product_salt')->withTimeStamps();
     }

     /**
     * An salt belongs to many ailments 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function ailments()
     {
        return $this->belongsToMany('App\Ailment','ailment_salt')->withTimeStamps();
     }

   /**
     * A salt belongs to or can have many classes 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function classes()
     {
        return $this->belongsToMany('App\Classes','classes_salt')->withTimeStamps();
     }

   /**
     * A salt belongs to or can have many salt categories 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function saltCategories()
     {
        return $this->belongsToMany('App\SaltCategory','salt_category_pivot')->withTimeStamps();
     }  

     /**
     * A salt belongs to or can have many schedule types 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function scheduleTypes()
     {
        return $this->belongsToMany('App\ScheduleType','salt_scheduletype')->withTimeStamps();
     }

     /**
      * Check if the given salt id has some products 
      * 
      * @param  int $saltId
      * @return bool
      */
     public static function checkIfSaltExistInProduct($saltId)
     {
        $salt = static::find($saltId);

        if(!is_null($salt)){
            if($salt->products()->count() != 0){
                return true;
            }
            return false;
        }
        return false;
     }

}
