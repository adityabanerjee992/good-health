<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	 /**
	  *  Specifies the Mass Assinable Fields
	  * @var array
	  */
    protected $fillable = [
     						'name',
     						'label'
                           ];
                           
    public function roles()
    {
    	return $this->belongsToMany(Role::class);
    }
}
