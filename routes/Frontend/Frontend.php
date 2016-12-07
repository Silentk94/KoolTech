<?php



/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('macros', 'FrontendController@macros')->name('macros');

//begin of invoice routes
Route::get('invoices', 'Invoices\InvoiceController@invoices');

Route::post('modifyinvoice','Invoices\InvoiceController@feed_records');

Route::post('clearinvoice','Invoices\InvoiceController@drop_records');

Route::get('saveinvoice/{invoiceid}','Invoices\InvoiceController@save_records');
//end of invoice routes

//begin of customer routes
Route::get('newcustomer', 'Customers\CustomerController@customer');

Route::post('addnewcustomer', 'Customers\CustomerController@addnewcustomer');

Route::get('updatecustomer','Customers\CustomerController@pickcustomer');

Route::post('searchcustomer','Customers\CustomerController@searchcustomer');

Route::post('modifycustomer','Customers\CustomerController@updatecustomer');


//end of customer routes

/**
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
	Route::group(['namespace' => 'User', 'as' => 'user.'], function() {
		/**
		 * User Dashboard Specific
		 */
		Route::get('dashboard', 'DashboardController@index')->name('dashboard');

		/**
		 * User Account Specific
		 */
		Route::get('account', 'AccountController@index')->name('account');

		/**
		 * User Profile Specific
		 */
		Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
	});
});