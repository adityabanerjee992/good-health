<?php

use App\User;

class AdminSeeder extends DatabaseSeeder {

	public function run()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		DB::table('users')->truncate(); // Using truncate function so all info will be cleared when re-seeding.
		DB::table('roles')->truncate();	
		DB::table('role_users')->truncate();

		       $payment_type = App\PaymentType::create([
            'name' => 'Cash On Delivery',
            'fee'  => 50,
            'description' => 'With COD you can pay in cash 
                              at the time of actual delivery 
                              of the product at your doorstep,
                              without requiring you to make any 
                              advance payment online.'
        ]);

		$admin = Sentinel::registerAndActivate(array(
			'email'       => 'admin@admin.com',
			'password'    => "admin",
			'first_name'  => 'John',
			'last_name'   => 'Doe',
		));

		$adminRole = Sentinel::getRoleRepository()->createModel()->create([
			'name' => 'Admin',
			'slug' => 'admin',
			'permissions' => [ 
			  "dashboard" => true,
			  "group.view" => true,
			  "group.create" => true,
			  "group.edit" => true,
			  "group.delete" => true,
			  "group.restore" => true,
			  "users" => true,
			  "create/user" => true,
			  "users.update" => true,
			  "delete/user" => true,
			  "restore/user" => true,
			  "users.show" => true,
			  "deleted_users" => true,
			  "cache-flush" => true,
			  "all-products" => true,
			  "bulk-upload" => true,
			  "product-create" => true,
			  "product-show" => true,
			  "product-edit" => true,
			  "delete-product" => true,
			  "all-salts" => true,
			  "salt-bulk-upload" => true,
			  "salt-create" => true,
			  "salt-show" => true,
			  "salt-edit" => true,
			  "delete-salt" => true,
			  "all-stores" => true,
			  "create-new-store" => true,
			  "store-show" => true,
			  "store-edit" => true,
			  "delete-store" => true,
			  "deleted-stores" => true,
			  "restore-store" => true,
			  "customers" => true,
			  "customers-edit" => true,
			  "delete/customer" => true,
			  "customers-show" => true,	
			  "deleted-customers" => true,
			  "restore/customer" => true,
			  "orders" => true,
			  "orders.askForPrescription" => true,
			  "orders.rejectOrder" => true,
			  "get-update-order-status" => true,
			  "orders.update" => true,
			  "orders.show" => true,
			  "view-order-logs-admin" => true]
		]);

		Sentinel::getRoleRepository()->createModel()->create([
			'name' => 'Central Verification Team',
			'slug' => 'central-verification-team',
			'permissions' => [ 
			  "dashboard" => true,
			  "all-products" => true,
			  "bulk-upload" => true,
			  "product-create" => true,
			  "product-show" => true,
			  "product-edit" => true,
			  "delete-product" => true,
			  "all-salts" => true,
			  "salt-bulk-upload" => true,
			  "salt-create" => true,
			  "salt-show" => true,
			  "salt-edit" => true,
			  "delete-salt" => true,
			  "all-stores" => true,
			  "create-new-store" => true,
			  "store-show" => true,
			  "store-edit" => true,
			  "delete-store" => true,	
			  "deleted-stores" => true,
			  "restore-store" => true,
			  "customers" => true,
			  "customers-edit" => true,
			  "delete/customer" => true,
			  "customers-show" => true,
			  "deleted-customers" => true,
			  "restore/customer" => true,
			  "orders" => true,
			  "orders.askForPrescription" => true,
			  "orders.rejectOrder" => true,
			  "get-update-order-status" => true,
			  "orders.update" => true,
			  "orders.show" => true]
		]);
		
		Sentinel::getRoleRepository()->createModel()->create([
			'name' => 'Chemist',
			'slug' => 'chemist',
			'permissions' => [ 
			  "orders" => true,
			  "orders.askForPrescription" => true,
			  "orders.rejectOrder" => true,
			  "get-update-order-status" => true,
			  "orders.update" => true,
			  "orders.show" => true]
		]);

		Sentinel::getRoleRepository()->createModel()->create([
			'name'  => 'User',
			'slug'  => 'user'
		]);

		$admin->roles()->attach($adminRole);
	}

}