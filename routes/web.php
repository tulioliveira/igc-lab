<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>'web'], function () {
	Route::get('/', 'LoansController@main')->name('loans.main');

	Route::resource('users', 'UsersController');

	Route::resource('equipment', 'EquipmentController');

	Route::get('/loans', 'LoansController@index')->name('loans.index');

	Route::post('/loans', 'LoansController@store')->name('loans.store');

	Route::post('/loans/return', 'LoansController@return')->name('loans.return');
});
