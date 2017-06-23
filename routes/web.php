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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/student', 'StudentsController@index');

Route::resource('student', 'StudentsController');

// Route::get('student/teste/{id}/{name}/{password}', 'StudentsController@teste');
