<?php namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

trait Register{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) 
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required|digits:10|unique:customers'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {        
        $model = Config::get('auth.model');
        return $model::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'api_key' => $data['api_key'],
            'phone' => (isset($data['phone']) and $data['phone'] != NULL)?$data['phone']:NULL,
            'password' => bcrypt($data['password'])
        ]);
    }
}

?>