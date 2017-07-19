<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class Loan extends Model
{
	protected $guarded = [];

	/**
	* The attributes that should be mutated to dates.
	*
	* @var array
	*/
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
		'loaned_on',
		'deadline',
		'returned_on'
	];

	public function student() {
		return $this->belongsTo('App\Student');
	}

	public function equipment() {
		return $this->belongsTo('App\Equipment');
	}

	public function status() {
		$current_time = Carbon::now()->toDayDateTimeString();
		if ($this->returned_on)
			return "Entregue";
		else{
			if($this->deadline->lt(Carbon::now()))
				return "Atrasado";
			else
				return "Emprestado";
		}
	}
}
