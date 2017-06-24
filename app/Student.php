<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $guarded = [];

	public function loans(){
		return $this->hasMany('App\Loan');
	}

	public function equipments(){
		return $this->belongsToMany('App\Equipment', 'loans')->withPivot('deadline', 'loaned_on','returned_on');
	}
}
