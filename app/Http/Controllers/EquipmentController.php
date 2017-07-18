<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentRequest;
use App\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$equipment = Equipment::all();
		return view('equipment.index', compact('equipment'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('equipment.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(EquipmentRequest $request)
	{
		Equipment::create($request->all());
	
		return redirect('/equipment');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$equipment = Equipment::find($id);

		return view('equipment.show', compact('equipment'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$equipment = Equipment::find($id);

		return view('equipment.edit', compact('equipment'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(EquipmentRequest $request, $id)
	{
		$equipment = Equipment::find($id);

		$equipment->update($request->all());

		return redirect('/equipment');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$equipment = Equipment::whereId($id)->delete();

		return redirect('/equipment');
	}
}
