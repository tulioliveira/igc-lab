<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	public function loans(){
		return $this->hasMany('App\Loan');
	}

	public function equipments(){
		return $this->belongsToMany('App\Equipment', 'loan');
	}
}
