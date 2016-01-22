<?php

namespace App\Http\Contracts;

interface ChangePassword
{
	/**
	 * Changes user password
	 * @param [string] $currentPassword [User current password]
	 * @param [string] $newPassword     [User new password]
	 * @param [string] $confirmPassword [User confirm password]
	 */
	public function changePassword($currentPassword,$newPassword,$confirmPassword);
}