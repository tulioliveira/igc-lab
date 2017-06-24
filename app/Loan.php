<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
	protected $guarded = [];
	
	public function student() {
		return $this->hasOne('App\Student');
	}

	public function equipment() {
		return $this->hasOne('App\Equipment')->withPivot('deadline', 'loaned_on','returned_on');
	}
}
