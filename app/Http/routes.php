<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Authentication routes..
Route::get('auth/login/{route?}', ['as' => 'login','uses' => 'Auth\AuthController@getLogin']);	
Route::post('auth/login/{route?}', ['as' => 'post-login','uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::post('check-user-pincode', ['as' => 'check-user-pincode' , 'uses' => 'PincodeController@checkPincode']);

// Registration routes...
Route::get('auth/register/{route?}',  ['as' => 'register','uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register/{route?}', ['middleware' => 'add_api_key','as' => 'post-register','uses' => 'Auth\AuthController@postRegister']);

//Logs View Routes...
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/',['as' => 'home' , 'uses'=>'HomeController@index']);
Route::get('/home',['as' => 'home' , 'uses'=>'HomeController@index']);

Route::group(array('prefix' => 'cart','middleware' => 'validate_token'), function(){

	Route::post('/add-product/{productId}',['as' => 'cart-add-product', 'uses' => 'CartController@add']);
	Route::post('/update-cart',['as' => 'update-cart', 'uses' => 'CartController@updateProductInCart']);
	Route::post('/delete-product-from-cart',['as' => 'delete-product-from-cart', 'uses' => 'CartController@deleteProductFromCart']);

	Route::get('/',['as' => 'cart','uses' => 'CartController@show']);
	Route::get('/upload-prescription',['as' => 'upload-prescription','uses' => 'CartController@getUploadPrescription']);
	Route::get('/choose-prescription',['as' => 'choose-prescription','uses' => 'CartController@getChoosePrescription']);
	Route::get('/link-prescription-to-order/{id}',['as' => 'link-prescription-to-order','uses' => 'CartController@linkPrescriptionToOrder']);
	Route::get('/link-address-to-order/{id}',['as' => 'link-address-to-order','uses' => 'CartController@linkAddressToOrder']);
	Route::post('/upload-prescription','CartController@postUploadPrescription');
	// Route::get('/upload-prescription',['as' => 'upload-prescription','middleware'=>'auth','CartController@uploadPrescription']);
	Route::get('/address',['as' => 'cart-address','uses' => 'CartController@address']);
	Route::get('/address/{id}/edit',['as' => 'cart-address-edit','uses' => 'AddressController@edit']);

	Route::get('/shipping-address','CartController@shippingAddress');
	Route::get('/order-summary',['as' => 'order-summary' , 'uses' => 'CartController@orderSummary']);
	Route::post('/order-confirmation',['as' => 'order-confirmation' , 'uses' => 'CartController@orderConfirmation']);
	Route::get('/checkout',['as' => 'checkout', 'uses' =>'CartController@checkout']);
	Route::post('/reorder',['as' => 'cart-reorder','middleware' => 'auth' , 'uses' =>'CartController@cartReorder']);
	Route::post('/cancel-order',['as' => 'cart-cancel-order','middleware' => 'auth' , 'uses' =>'CartController@cartCancelOrder']);

});

Route::post('coupon/apply-coupon',['as' => 'apply-coupon', 'uses' => 'CouponController@applyCoupon']);


Route::get('drugs/by-ailments',['as' => 'drugs-by-ailment', 'uses' => 'DrugsController@byAilments']);
// Route::get('drugs/by-ailments/{id}','DrugsController@getMedicinesUnderAilments');
// Route::get('drugs/by-ailments/{category}/{subCategory}','DrugsController@getMedicineDetails');

Route::get('drugs/by-class',['as' => 'drugs-by-class', 'uses' => 'DrugsController@byClass']);
// Route::get('drugs/by-class/{category}','DrugsController@getMedicinesUnderClass');
// Route::get('drugs/by-class/{category}/{subCategory}','DrugsController@getMedicineDetails');

Route::get('drugs/by-manufacturer',['as' => 'drugs-by-manufacturer', 'uses' => 'DrugsController@byManufacturer']);
// Route::get('drugs/by-company/{category}','DrugsController@getMedicinesUnderCompany');
// Route::get('drugs/by-company/{category}/{subCategory}','DrugsController@getMedicineDetails');

Route::get('drugs/by-az',['as' => 'drugs-by-az', 'uses' => 'DrugsController@byAZ']);
// Route::get('drugs/by-az/{category}','DrugsController@getMedicinesUnderAZ');
// Route::get('drugs/by-az/{category}/{subCategory}','DrugsController@getMedicineDetails');


Route::get('form-search/{query}',['as' => 'home-page-search', 'uses' => 'SearchController@postSearch']);
Route::get('form-search-full/{query}',['as' => 'home-page-search-full', 'uses' => 'SearchController@fullSearch']);

Route::get('salt/by-ailments/{id}',['as' => 'salts-by-ailment', 'uses' => 'SaltsController@getSaltsByAilments']);
Route::get('salt/by-class/{id}',['as' => 'salts-by-class', 'uses' => 'SaltsController@getSaltsByClass']);

//ProductController Routes
Route::get('products/list',['as' => 'list-products' , 'uses' => 'ProductController@listProducts']);
Route::get('products/details/{id}',['as' => 'product-details' , 'uses' => 'ProductController@getProductDetailes']);
Route::get('products/by-salt/{id}',['as' => 'products-by-salt' , 'uses' => 'ProductController@getProductsBySalt']);
Route::get('products/by-ailment/{ailmentId}',['as' => 'products-by-ailment' , 'uses' => 'ProductController@getProductsByAilment']);
Route::get('products/by-ailment/{classId}',['as' => 'products-by-class' , 'uses' => 'ProductController@getProductsByClass']);
Route::get('products/by-company/{id}',['as' => 'products-by-company' , 'uses' => 'ProductController@getProductsByCompany']);
Route::get('products/by-manufacturer/{id}',['as' => 'products-by-manufacturer' , 'uses' => 'ProductController@getProductsByManufacturer']);

//AddressController Routes
Route::get('address/add-new',['as' => 'address-add-new' , 'uses' => 'AddressController@create']);
Route::post('address/add-new','AddressController@store');
Route::get('address/{id}/edit',['as' => 'edit-address' , 'uses' => 'AddressController@edit']);
Route::post('address/edit',['as' => 'update-address' , 'uses' => 'AddressController@update']);
Route::post('address/delete',['as' => 'delete-address' , 'uses' => 'AddressController@destroy']);

//UserAccountController Routes
Route::group(['prefix'=>'my-account','middleware' => 'auth'],function(){
	Route::get('account-information',['as' => 'my-account-info' , 'uses' => 'UserAccountController@getUserAccount']);
	Route::post('account-information',['as' => 'my-account-info-post' , 'uses' => 'UserAccountController@postUserAccount']);
	Route::get('my-address',['as' => 'my-address' , 'uses' => 'UserAccountController@userAddresses']);
	Route::get('my-orders',['as' => 'my-orders' , 'uses' => 'UserAccountController@userOrders']);
	Route::get('print-order/{orderId}',['as' => 'print-order' , 'uses' => 'UserAccountController@printOrder']);
	Route::get('my-order-details/{id}',['as' => 'my-account-order-details' , 'uses' => 'UserAccountController@userOrderDetails']);
	Route::get('my-order-details/{id}/document-edit',['as' => 'my-account-order-details-doc-edit' , 'uses' => 'UserAccountController@getEditDocument']);
	Route::get('my-documents/{type}',['as' => 'my-documents' , 'uses' => 'UserAccountController@userDocuments']);
	Route::get('my-documents/{documentId}/edit',['as' => 'edit-document' , 'uses' => 'UserAccountController@getEditDocument']);
	Route::post('my-documents/{documentId}/edit',['as' => 'post-edit-document' , 'uses' => 'UserAccountController@postEditDocument']);
	Route::post('my-documents/delete',['as' => 'post-delete-document' , 'uses' => 'UserAccountController@postDeleteDocument']);
});

//DocumentUploadController Routes
Route::get('document/get/{documentId}',['as' => 'get-document' , 'uses' => 'DocumentUploadController@get']);

//Api Routes 
Route::group(['prefix' => 'api/v1' , 'middleware' => 'check_api_key'],function(){
	Route::post('login',['as' => 'api-user-login', 'uses' => 'Api\LoginController@login']);
	Route::post('register',['as' => 'api-user-register', 'middleware' => 'add_api_key','uses' => 'Api\RegisterCustomerController@registerCustomer']);
	Route::post('document-upload',['as' => 'api-document-upload', 'uses' => 'Api\DocumentUploadController@store']);
	Route::post('products-search/{query}',['as' => 'api-products-search', 'uses' => 'Api\ProductController@search']);
	Route::post('products-catalog',['as' => 'api-products-catalog', 'uses' => 'Api\ProductController@all']);
	Route::post('product-details',['as' => 'api-product-details', 'uses' => 'Api\ProductController@show']);
	
	Route::group(['prefix' => '/customer'] , function(){
		Route::post('user-documents',['as' => 'api-user-documents', 'uses' => 'Api\UserAccountController@userDocuments']);
		Route::post('user-account-info',['as' => 'api-user-accountinfo', 'uses' => 'Api\UserAccountController@userAccountInformation']);
		Route::post('update-account-info',['as' => 'api-update-accountinfo', 'uses' => 'Api\UserAccountController@updateUserAccountInformation']);
		Route::post('change-account-password',['as' => 'api-change-account-password', 'uses' => 'Api\UserAccountController@changePassword']);
		Route::post('user-address',['as' => 'api-user-address', 'uses' => 'Api\UserAccountController@userAddress']);
	});

	Route::group(['prefix' => '/cart'],function(){
		Route::post('/add-product',['as' => 'api-add-product', 'uses' => 'Api\CartController@add']);
		Route::post('/view',['as' => 'api-view-cart', 'uses' => 'Api\CartController@view']);
		Route::post('/update',['as' => 'api-udpate-cart', 'uses' => 'Api\CartController@update']);
		Route::post('/delete-product',['as' => 'api-delete-product', 'uses' => 'Api\CartController@delete']);
	});		

	Route::group(['prefix' => '/address'],function(){
		Route::post('/add-address',['as' => 'api-add-address', 'uses' => 'Api\AddressController@add']);
		Route::post('/view',['as' => 'api-view-address', 'uses' => 'Api\AddressController@get']);
		Route::post('/update',['as' => 'api-udpate-address', 'uses' => 'Api\AddressController@update']);
		Route::post('/delete-address',['as' => 'api-delete-address', 'uses' => 'Api\AddressController@delete']);
		Route::post('/link-address-to-order',['as' => 'api-link-address-to-order', 'uses' => 'Api\AddressController@linkAddressToOrder']);
	});		

	Route::group(['prefix' => '/order'],function(){
		Route::post('/link-address-to-order',['as' => 'api-link-address-to-order', 'uses' => 'Api\OrderController@linkAddressToOrder']);
		Route::post('/order-status-to-confirmed',['as' => 'order-status-to-confirmed', 'uses' => 'Api\OrderController@changeOrderStatusToConfirmed']);
	});	
});


// Route::get('admin/login', ['as' => 'login-admin','uses' => 'Admin\Auth\AuthController@getLogin']);
// Route::post('admin/login', ['as' => 'signin' ,'uses' => 'Admin\Auth\AuthController@postLogin']);
// Route::get('admin/logout', 'Admin\Auth\AuthController@getLogout');


// Registration routes...
// Route::get('admin/register', ['as' => 'signup' , 'uses' => 'Admin\Auth\AuthController@getRegister']);
// Route::post('admin/register', 'Admin\Auth\AuthController@postRegister');
// Route::post('admin/forgot-password',array('as' => 'forgot-password','uses' => 'Admin\Auth\AuthController@postForgotPassword'));


# Dashboard / Index
// Route::get('/', array('as' => 'dashboard','uses' => 'Admin\RoleManagementController@index'));

// Admin Routes 
// Route::group(['prefix' => 'admin', 
//               'middleware' => ['auth']       
//  	], 
// function () {
// 	// Roles Routes
// 	Route::get('role',['as'=>'list-role','uses' => 'Admin\RoleManagementController@index']);
// 	Route::get('role/create',['as'=>'role-create','uses' => 'Admin\RoleManagementController@create']);
// 	Route::post('role',['as'=>'role-store','uses' => 'Admin\RoleManagementController@store']);
// 	Route::get('role/{id}/edit',['as'=>'role-edit','uses' => 'Admin\RoleManagementController@edit']);
// 	Route::put('role/{id}',['as'=>'role-update','uses' => 'Admin\RoleManagementController@update']);
// 	Route::delete('role/{id}',['as'=>'role-delete','uses' => 'Admin\RoleManagementController@delete']);

// 	// Permission Routes
// 	Route::get('permission',['as'=>'list-permission','uses' => 'Admin\PermissionManagementController@index']);
// 	Route::get('permission/create',['as'=>'permission-create','uses' => 'Admin\PermissionManagementController@create']);
// 	Route::post('permission',['as'=>'permission-store','uses' => 'Admin\PermissionManagementController@store']);
// 	Route::get('permission/{id}/edit',['as'=>'permission-edit','uses' => 'Admin\PermissionManagementController@edit']);
// 	Route::put('permission/{id}',['as'=>'permission-update','uses' => 'Admin\PermissionManagementController@update']);
// 	Route::delete('permission/{id}',['as'=>'permission-delete','uses' => 'Admin\PermissionManagementController@delete']);

// 	//Role Permission Controller Routes
// 	Route::get('role-permissions/{roleId}',['as' => 'role-permissions', 'uses' => 'Admin\RolePermissionController@index']);
// 	Route::get('role-permissions/create/{roleId}',['as' => 'role-permissions-create', 'uses' => 'Admin\RolePermissionController@create']);
// 	Route::post('role-permissions',['as' => 'role-permissions-store', 'uses' => 'Admin\RolePermissionController@store']);

// 	//User Management Routes : 
// 	Route::get('users',['as' => 'users-list','uses' => 'Admin\UserManagementController@index']);
// });


/**
* Sentinel filter
*
* Checks if the user is logged in
*/
Route::filter('Sentinel', function()
{
	if ( ! Sentinel::check()) {
		return Redirect::to('admin/signin')->with('error', 'You must be logged in!');
	}	
});

/**
 * Model binding into route
 */
Route::model('blogcategory', 'App\BlogCategory');
Route::model('blog', 'App\Blog');
Route::pattern('slug', '[a-z0-9- _]+');

Route::group(array('prefix' => 'admin','middleware' => 'acl'), function () {

	# Error pages should be shown without requiring login
	Route::get('404', function () {
		return View('admin/404');
	});
	Route::get('500', function () {
		return View::make('admin/500');
	});

	# Lock screen
	Route::get('lockscreen', function () {
		return View::make('admin/lockscreen');
	});

		# All basic routes defined here
	Route::get('signin', array('as' => 'signin','uses' => 'Admin\AuthController@getSignin'));
	Route::post('signin','Admin\AuthController@postSignin');
	Route::post('signup',array('as' => 'signup','uses' => 'Admin\AuthController@postSignup'));
	Route::post('forgot-password',array('as' => 'forgot-password','uses' => 'Admin\AuthController@postForgotPassword'));
	Route::get('login2', function () {
		return View::make('admin/login2');
	});

	# Register2
	Route::get('register2', function () {
		return View::make('admin/register2');
	});
	Route::post('register2',array('as' => 'register2','uses' => 'Admin\AuthController@postRegister2'));
	
	# Forgot Password Confirmation
	Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'Admin\AuthController@getForgotPasswordConfirm'));
	Route::post('forgot-password/{userId}/{passwordResetCode}', 'Admin\AuthController@postForgotPasswordConfirm');

    # Logout
	Route::get('logout', array('as' => 'logout','uses' => 'Admin\AuthController@getLogout'));

	# Account Activation
	Route::get('activate/{userId}/{activationCode}', array('as' => 'activate', 'uses' => 'Admin\AuthController@getActivate'));

    # Dashboard / Index
	Route::get('/', array('as' => 'dashboard','permission' => 'dashboard' , 'uses' => 'Admin\BaseController@showHome'));


	# Cache Management
	Route::get('/cache-flush', array('as' => 'cache-flush', 'uses' => 'Admin\CacheController@flushAllCache'));


	# User Management
	Route::group(array('prefix' => 'users','before' => 'Sentinel'), function () {
		Route::get('/', array('as' => 'users', 'uses' => 'Admin\UsersController@getIndex'));
		Route::get('create', array('as' => 'create/user', 'uses' => 'Admin\UsersController@getCreate'));
		Route::post('create', 'Admin\UsersController@postCreate');
		Route::get('{userId}/edit', array('as' => 'users.update', 'uses' => 'Admin\UsersController@getEdit'));
		Route::post('{userId}/edit', 'Admin\UsersController@postEdit');
		Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'Admin\UsersController@getDelete'));
		Route::get('{userId}/confirm-delete', array('as' => 'confirm-delete/user', 'uses' => 'Admin\UsersController@getModalDelete'));
		Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'Admin\UsersController@getRestore'));
		Route::get('{userId}', array('as' => 'users.show', 'uses' => 'Admin\UsersController@show'));
	});
	Route::get('deleted_users',array('as' => 'deleted_users','before' => 'Sentinel', 'uses' => 'Admin\UsersController@getDeletedUsers'));
	
	# Product Management
	Route::group(array('prefix' => 'products','before' => 'Sentinel'), function () {
		Route::get('/', array('as' => 'all-products', 'uses' => 'Admin\ProductController@getAllProducts'));
		Route::get('/get-products-ajax', array('as' => 'all-products-ajax', 'uses' => 'Admin\ProductController@getProductsAjax'));
		Route::get('/bulk-upload', array('as' => 'bulk-upload','uses' => 'Admin\ProductController@getBulkUpload'));
		Route::post('/bulk-upload', array('as' => 'post-bulk-upload', 'uses' => 'Admin\ProductController@postBulkUpload')); 	
		Route::get('create', array('as' => 'product-create', 'uses' => 'Admin\ProductController@getCreate'));
		Route::post('create', array('as' => 'post-product-create','uses' => 'Admin\ProductController@postCreate'));
		Route::get('{id}', array('as' => 'product-show', 'uses' => 'Admin\ProductController@show'));
		Route::get('{id}/edit', array('as' => 'product-edit', 'uses' => 'Admin\ProductController@getEdit'));
		Route::post('{id}/edit', array( 'as' => 'post-product-edit','uses' => 'Admin\ProductController@postEdit'));
		Route::get('{id}/confirm-delete', array('as' => 'confirm-delete-product', 'uses' => 'Admin\ProductController@getModalDelete'));
		Route::delete('{id}/delete',['as' => 'delete-product', 'uses' => 'Admin\ProductController@destroy']);
	});

	//StoreManagementController Routes
Route::group(array('prefix' => 'stores','before' => 'Sentinel'),function(){
	Route::get('/',['as' => 'all-stores' , 'uses' => 'Admin\StoreManagementController@index']);
	Route::get('/create',['as' => 'create-new-store' , 'uses' => 'Admin\StoreManagementController@create']);
	Route::post('/',['as' => 'post-store-create' , 'uses' => 'Admin\StoreManagementController@store']);
	Route::get('/show/{id}',['as' => 'store-show' , 'uses' => 'Admin\StoreManagementController@show']);
	Route::get('/{id}/edit',['as' => 'store-edit' , 'uses' => 'Admin\StoreManagementController@edit']);
	Route::put('/{id}',['as'=>'store-update','uses' => 'Admin\StoreManagementController@update']);
	Route::get('{id}/confirm-delete', array('as' => 'confirm-delete-store', 'uses' => 'Admin\StoreManagementController@getModalDelete'));
	Route::get('{id}/restore', array('as' => 'restore-store', 'uses' => 'Admin\StoreManagementController@getRestore'));
	Route::delete('{id}/delete',['as' => 'delete-store', 'uses' => 'Admin\StoreManagementController@destroy']);
	Route::get('/deleted-stores',array('as' => 'deleted-stores','before' => 'Sentinel', 'uses' => 'Admin\StoreManagementController@getDeletedStores'));
});

	# Salt Management
Route::group(array('prefix' => 'salts','before' => 'Sentinel'), function () {
	Route::get('/', array('as' => 'all-salts', 'uses' => 'Admin\SaltController@getAllSalts'));
	Route::get('/get-salts-ajax', array('as' => 'all-salts-ajax', 'uses' => 'Admin\SaltController@getSaltsAjax'));
	Route::get('/bulk-upload', array('as' => 'salt-bulk-upload', 'uses' => 'Admin\SaltController@getBulkUpload'));
	Route::post('/bulk-upload', array('as' => 'post-salt-bulk-upload', 'uses' => 'Admin\SaltController@postBulkUpload')); 	
	Route::get('create', array('as' => 'salt-create', 'uses' => 'Admin\SaltController@getCreate'));
	Route::post('create', array('as' => 'post-salt-create','uses' => 'Admin\SaltController@postCreate'));
	Route::get('{id}', array('as' => 'salt-show', 'uses' => 'Admin\SaltController@show'));
	Route::get('{id}/edit', array('as' => 'salt-edit', 'uses' => 'Admin\SaltController@getEdit'));
	Route::post('{id}/edit', array( 'as' => 'post-salt-edit','uses' => 'Admin\SaltController@postEdit'));
	Route::get('{id}/confirm-delete', array('as' => 'confirm-delete-salt', 'uses' => 'Admin\SaltController@getModalDelete'));
	Route::delete('{id}/delete',['as' => 'delete-salt', 'uses' => 'Admin\SaltController@destroy']);
});

	# Customer Management
Route::group(array('prefix' => 'customers','before' => 'Sentinel'), function () {
	Route::get('/', array('as' => 'customers', 'uses' => 'Admin\CustomerController@getIndex'));
	Route::get('create', array('as' => 'create/customer', 'uses' => 'Admin\CustomerController@getCreate'));
	Route::post('create', 'Admin\CustomerController@postCreate');
	Route::get('{customerId}/edit', array('as' => 'customers-edit', 'uses' => 'Admin\CustomerController@getEdit'));
	Route::post('{customerId}/edit', array('as' => 'customers-update','uses' => 'Admin\CustomerController@postEdit'));
	Route::get('{customerId}/delete', array('as' => 'delete/customer', 'uses' => 'Admin\CustomerController@getDelete'));
	Route::get('{customerId}/confirm-delete', array('as' => 'confirm-delete/customer', 'uses' => 'Admin\CustomerController@getModalDelete'));
	Route::get('{customerId}/restore', array('as' => 'restore/customer', 'uses' => 'Admin\CustomerController@getRestore'));
	Route::get('{customerId}', array('as' => 'customers-show', 'uses' => 'Admin\CustomerController@show'));
	Route::delete('{id}/delete',['as' => 'delete-customers', 'uses' => 'Admin\CustomerController@destroy']);
});
Route::get('deleted-customers',array('as' => 'deleted-customers','uses' => 'Admin\CustomerController@getDeletedCustomers'));

# Order Management
Route::group(array('prefix' => 'orders','before' => 'Sentinel'), function () {
	Route::get('/', array('as' => 'orders', 'uses' => 'Admin\OrderController@listAllOrders'));
	Route::get('create', array('as' => 'create/order', 'uses' => 'Admin\OrderController@getCreate'));
	Route::post('create', 'Admin\OrderController@postCreate');
	Route::get('/ask-for-prescription/{orderId}', array('as' => 'orders.askForPrescription', 'uses' => 'Admin\OrderController@askForPrescription'));
	Route::get('/ask-for-prescription-update/{prescriptionId}/{orderId}', array('as' => 'orders.askForPrescriptionUpdate', 'uses' => 'Admin\OrderController@askForPrescriptionUpdate'));
	Route::get('/reject-order/{orderId}', array('as' => 'orders.rejectOrder', 'uses' => 'Admin\OrderController@getRejectOrder'));
	Route::post('/reject-order', array('as' => 'post-reject-order', 'uses' => 'Admin\OrderController@postRejectOrder'));
	Route::get('/update-status/{orderId}', array('as' => 'get-update-order-status', 'uses' => 'Admin\OrderController@getUpdateOrderStatus'));
	Route::post('/update-status', array('as' => 'post-update-order-status', 'uses' => 'Admin\OrderController@postUpdateOrderStatus'));
	Route::get('{orderId}/edit', array('as' => 'orders.edit', 'uses' => 'Admin\OrderController@getEditOrder'));
	Route::post('{orderId}/edit', array('as' => 'orders.udpate','uses' => 'Admin\OrderController@postEditOrder'));
	Route::get('{orderId}/delete', array('as' => 'delete/order', 'uses' => 'Admin\OrderController@getDelete'));
	Route::get('{orderId}/confirm-delete', array('as' => 'confirm-delete/order', 'uses' => 'Admin\OrderController@getModalDelete'));
	Route::get('{orderId}/restore', array('as' => 'restore/order', 'uses' => 'Admin\OrderController@getRestore'));
	Route::get('{orderId}', array('as' => 'orders.show', 'uses' => 'Admin\OrderController@show'));
	Route::get('/view-logs/{orderId}',['as' => 'view-order-logs-admin' , 'uses' => 'Admin\OrderController@viewLogs']);
	Route::get('print-order/{orderId}',['as' => 'print-order-admin' , 'uses' => 'UserAccountController@printOrder']);
});
Route::get('deleted_orders',array('as' => 'deleted_orders','before' => 'Sentinel', 'uses' => 'Admin\OrderController@getDeletedOrders'));

	# Group Management
Route::group(array('prefix' => 'groups','before' => 'Sentinel'), function () {
	Route::get('/', array('as' => 'groups', 'permission' => 'group.view', 'uses' => 'Admin\GroupsController@getIndex'));
	Route::get('create', array('as' => 'create/group', 'permission' => 'group.create' ,'uses' => 'Admin\GroupsController@getCreate'));
	Route::post('create', ['permission' => 'group.create','uses' => 'Admin\GroupsController@postCreate']);
	Route::get('{groupId}/edit', array('as' => 'update/group', 'permission' => 'group.edit' ,'uses' => 'Admin\GroupsController@getEdit'));
	Route::post('{groupId}/edit', [ 'permission' => 'group.edit','uses' => 'Admin\GroupsController@postEdit']);
	Route::get('{groupId}/delete', array('as' => 'delete/group',  'permission' => 'group.delete' , 'uses' => 'Admin\GroupsController@getDelete'));
	Route::get('{groupId}/confirm-delete', array('as' => 'confirm-delete/group',  'permission' => 'group.delete', 'uses' => 'Admin\GroupsController@getModalDelete'));
	Route::get('{groupId}/restore', array('as' => 'restore/group',  'permission' => 'group.restore' ,'uses' => 'Admin\GroupsController@getRestore'));
});	

Route::post('crop_demo','Admin\BaseController@crop_demo');

/* laravel example routes */
	# datatables
Route::get('datatables', 'Admin\DataTablesController@index');
Route::get('datatables/data', array('as' => 'admin.datatables.data', 'uses' => 'Admin\DataTablesController@data'));

	# Remaining pages will be called from below controller method
	# in real world scenario, you may be required to define all routes manually

Route::get('{name?}', 'Admin\BaseController@showView');
});
//admin route ends here


 Route::get('docs', function(){
            	return View::make('docs.apidoc.index');
            });
