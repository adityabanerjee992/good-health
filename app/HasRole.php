<?php namespace App;

trait HasRole{
	
    public function roles()
    {   
        return $this->belongsToMany(Role::class);
    }

    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    public function hasRole($role)
    {
        if(is_string($role)){
            return $this->roles->containes('name',$role);
        }
        
        return !! $role->intersect($this->roles)->count();
    }
}