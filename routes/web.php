<?php

use App\Student;
use App\Equipment;

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

Route::get('/', function () {
    return view('index');
});


Route::group(['middleware'=>'web'], function () {
	Route::resource('students', 'StudentsController');

	Route::resource('equipment', 'EquipmentController');

	Route::get('/loans', 'LoansController@index')->name('loans.index');

	Route::post('/loans', 'LoansController@store')->name('loans.store');
});
