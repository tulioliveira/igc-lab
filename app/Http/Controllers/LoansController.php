<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Loan;
use App\Student;
use App\Equipment;
use Carbon\Carbon;

class LoansController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$loans = Loan::latest()->paginate(20);
		return view('loans.index', compact('loans'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$messages = [
			'student_enrollment.required'   => 'O campo Matrícula é obrigatório.',
			'student_enrollment.size'       => 'O campo Matrícula deve ter 10 caracteres.',
			'student_enrollment.exists'     => 'Matrícula selecionada é inválida.',
			'loan_equipment_code.required'  => 'O campo Código é obrigatório.',
			'loan_equipment_code.alpha_num' => 'Código deve conter somente letras e números.',
			'loan_equipment_code.exists'    => 'Código selecionado é inválido.',
		];

		$validator = Validator::make($request->all(), [
			'student_enrollment'  => 'required|alpha_num|size:10|exists:students,enrollment', 
			'loan_equipment_code' => 'required|alpha_num|exists:equipment,code',
		], $messages);

		if ($validator->fails()) {
			return redirect('/loans')->withErrors($validator, 'loanErrors')->withInput();
		}

		$student = Student::where('enrollment', '=', $request->student_enrollment)->first();
		$equipment = Equipment::where('code', '=', $request->loan_equipment_code)->first();

		// Verify if equipment has open loan
		if($loan = Loan::where('returned_on', '=', null)->where('equipment_id', '=', $equipment->id)->first()) {
			$loan->returned_on = Carbon::now();
			$loan->save();
		}

		// Create the new loan
		$loan = new Loan;

		$loan->student_id = $student->id;
		$loan->equipment_id = $equipment->id;
		$loan->loaned_on = Carbon::now();
		$loan->deadline = Carbon::now()->addDays($equipment->time);
		
		$loan->save();
		
		return redirect('/loans');
	}

	/**
	 * Update a loan return datetime to now()
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function return(Request $request) {
		$messages = [
			'return_equipment_code.required'  => 'O campo Código é obrigatório.',
			'return_equipment_code.alpha_num' => 'Código deve conter somente letras e números.',
			'return_equipment_code.exists'    => 'Código selecionado é inválido.',
		];

		$validator = Validator::make($request->all(), [
			'return_equipment_code' => 'required|alpha_num|exists:equipment,code',
		], $messages);

		if ($validator->fails()) {
			return redirect('/loans')->withErrors($validator, 'returnErrors')->withInput();
		}

		$equipment = Equipment::where('code', '=', $request->return_equipment_code)->first();

		// Verify if equipment has open loan
		if($loan = Loan::where('returned_on', '=', null)->where('equipment_id', '=', $equipment->id)->first()) {
			$loan->returned_on = Carbon::now();
			$loan->save();
		}

		return redirect('/loans');
	}

	/**
	 * Show the latest loans and most required equipment
	 * @return \Illuminate\Http\Response
	 */
	public function main(){
		$loans = Loan::orderBy('created_at', 'desc')->take(5)->get();
		$equipment = Equipment::withCount('loans')->orderBy('loans_count', 'desc')->take(20)->get();

		return view('index', compact('loans', 'equipment'));
	}
}
