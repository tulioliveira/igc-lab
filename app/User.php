<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $guarded = [];

	public function loans(){
		return $this->hasMany('App\Loan')->orderBy('loaned_on', 'desc');
	}

	public function equipments(){
		return $this->belongsToMany('App\Equipment', 'loans')->withPivot('deadline', 'loaned_on','returned_on');
	}
}
