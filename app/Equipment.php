<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Loan;

class Equipment extends Model
{
	protected $guarded = [];

	public function loans(){
		return $this->hasMany('App\Loan');
	}

	public function students(){
		return $this->belongsToMany('App\Student', 'loans')->withPivot('deadline', 'loaned_on','returned_on');
	}

	public function isLoaned() {
		try {
			$loan = Loan::where('returned_on', '=', null)->where('equipment_id', '=', $this->id)->firstOrFail();
		} catch (ModelNotFoundException $ex) {
			return false;
		}
		return true;
	}
}
