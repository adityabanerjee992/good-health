<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Contracts\ChangePassword as ChangePassword;

class ChangePasswordController extends Controller implements ChangePassword
{
	/**
	 * Changes user password
	 * @param [string] $currentPassword [User current password]
	 * @param [string] $newPassword     [User new password]
	 * @param [string] $confirmPassword [User confirm password]
	 */
	public function changePassword($currentPassword,$newPassword,$confirmPassword)
	{
		$validator = Validator::make(Input::all(),
			array(
				'current_password'	=> 'required|min:6',
				'new_password' 		=> 'required',
				'confirm_password'  => 'required|same:current_password',

				  'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
			)
		);

		if($validator->fails()) {
			return Redirect::route('my-account-info')
				->withErrors($validator);
		} else {
			dd('Password Changed');
		}
	}
}
