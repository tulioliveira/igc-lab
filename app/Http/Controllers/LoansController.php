<?php

namespace App\Http\Controllers;

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
		$loans = Loan::all();
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

		try {
			$student = Student::where('enrollment', '=', $request->student_enrollment)->firstOrFail();
		} catch (ModelNotFoundException $ex) {
			return false;
		}
		try {
			$equipment = Equipment::where('code', '=', $request->equipment_code)->firstOrFail();
		} catch (ModelNotFoundException $ex) {
			return false;
		}

		$loan = new Loan;

		$loan->student_id = $student->id;
		$loan->equipment_id = $equipment->id;
		$loan->loaned_on = Carbon::now();
		$loan->deadline = Carbon::now()->addDays($equipment->time);
		
		$loan->save();
		
		return redirect('/loans');
	}
}
