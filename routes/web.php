<?php

use App\Student;

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

Route::resource('student', 'StudentsController');

/*
|--------------------------------------------------------------------------
| ORM Eloquent
|--------------------------------------------------------------------------
*/

Route::get('/find', function() {
	// $student = Student::where('id', 2015012961)->orderBy('id', 'desc')->take(1)->get();

	$student = Student::findOrFail(2015012961);

	// $student = Student::withTrashed()->where('id', 2015012961)->get();

	return $student;	
});

Route::get('/create', function() {
	$student = new Student;

	$student->id = 2015012961;
	$student->name = "The name";
	$student->cpf = "069.700.756-14";
	$student->email= "tulio.ao@gmail.com";
	$student->course= "Engenharia de Controle e Automação";
	$student->zipcode= "30160-042";
	$student->street= "Rua Rio de Janeiro";
	$student->city= "Belo Horizonte";
	$student->state= "MG";
	$student->number= 1288;
	$student->complement= "Apt 404";
	$student->phone= "(31) 99966-2573";

	$student->save();

	return $student;
});

Route::get('/update/{id}', function($id) {
	$student = Student::find($id);

	$student->name = "Frank Fontaine";

	$student->update();

	Student::where('id', 2015012961)->update(['email'=>'frank@gmail.com']);

	return $student;
});

Route::get('/delete/{id}', function($id) {
	$student = Student::withTrashed()->find($id);

	$student->delete();

	// $student->forceDelete();

	return $student;

	// Student::destroy($id);

});

Route::get('/restore/{id}', function($id) {
	$student = Student::onlyTrashed()->find($id);

	$student->restore();

	return $student;

	// Student::destory($id);

});

/*
|--------------------------------------------------------------------------
| Raw SQL Queries
|--------------------------------------------------------------------------
*/

Route::get('/insert', function() {
	DB::insert('INSERT INTO students(id,cpf,name,email,course,zipcode,street,city,state,number,complement,phone) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)',[2015012960,'069.700.756-13', 'Tulio Araujo de Oliveira', 'tulio.ao@gmail.com', 'Engenharia de Controle e Automação', '30160-042', 'Rua Rio de Janeiro', 'Belo Horizonte', 'MG', 1288, 'Apt 404', '(31) 99966-2573']);

	return "inserted!";
});

Route::get('/read', function() {
	$result = DB::select('SELECT * FROM students WHERE name LIKE "Tulio%"');

	return var_dump($result);
});

Route::get('/update', function() {
	$result = DB::update("UPDATE students SET name=? WHERE id=?", ['Epitaph', 2015012960]);
	
	return $result;
});

Route::get('/delete', function() {
	$result = DB::update("DELETE FROM students WHERE id=?", [2015012960]);
	
	return $result;
});

