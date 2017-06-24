<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
	protected $guarded = [];

	public function loans(){
		return $this->hasMany('App\Loan');
	}

	public function students(){
		return $this->belongsToMany('App\Student', 'loans')->withPivot('deadline', 'loaned_on','returned_on');
	}
}
