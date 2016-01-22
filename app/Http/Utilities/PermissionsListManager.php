<?php namespace App\Http\Utilities;

Class PermissionsListManager {

	// public static $allPermissions=['GroupManagement' => ['group.view',
	// 													 'group.create',
	// 													 'group.edit',
	// 													 'group.delete'
	// 													],
	// 							  ];

	public static $allPermissions=[
								   'dashboard'  => 'View Dashboard',
								   
								   'group.view' => 'View Group',
								   'group.create' => 'Create Group',
								   'group.edit'  => 'Edit Group',
								   'group.delete' => 'Delete Group',
								   'group.restore' => 'Restore Group',
								   
								   'users'		 => 'List Users',
								   'create/user' => 'Create New User',
								   'users.update' => 'Update User',
								   'delete/user'  => 'Delete User',
								   'restore/user' => 'Restore User',
								   'users.show'   => 'View User',
								   'deleted_users' => 'View Deleted Users',
								   
								   'cache-flush'   => 'Flush Application Cache',
								   
								   'all-products'  => 'View Products',
								   'bulk-upload'   => 'Product Bulk Import',
								   'product-create' => 'Create New Product',
								   'product-show'   => 'View Product',
								   'product-edit'	=> 'Edit Product',
								   'delete-product'	=> 'Delete Product',								   

								   'all-salts'  => 'View Salts',
								   'salt-bulk-upload'   => 'Salt Bulk Import',
								   'salt-create' => 'Create New Salt',
								   'salt-show'   => 'View Salt',
								   'salt-edit'	=> 'Edit Salt',
								   'delete-salt'	=> 'Delete Salt',

								   'all-stores'		=> 'View All Stores',
								   'create-new-store' => 'Create New Store',
								   'store-show'		=>	'View Store',
								   'store-edit'		=> 'Edit Store',
								   'delete-store'	=> 'Delete Store',
								   'deleted-stores'	=> 'View Deleted Stores',
								   'restore-store'	=> 'Restore Deleted Store',

								   'customers'		=> 'View All Customers',
								   // 'create/customer' => 'Create New Customer',
								   'customers-edit' => 'Edit The Customer',
								   'delete/customer'=> 'Delete Customer',
								   'customers-show' => 'View Customer',
								   'deleted-customers' => 'View Deleted Customers',
								   'restore/customer'  => 'Restore Deleted Customer',

								   'orders'					   => 'View All Orders',
								   'orders.askForPrescription' => 'Permission To Ask For Prescription',
								   'orders.rejectOrder'		   => 'Permission To Reject Order',
								   'get-update-order-status'   => 'Permission To Update Order Status',
								   'orders.update'			   => 'Permission To Edit The Order',
								   'orders.show'			   => 'Permission To View Order',
								   'view-order-logs'		   => 'View Order Logs '
 								  ];

	public static function getAllPermissions()
	{
		return static::$allPermissions;
	}
}

?>