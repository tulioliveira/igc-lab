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

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function equipment() {
		return $this->belongsTo('App\Equipment');
	}

	public function isLate()  {
		if ((!$this->returned_on) && ($this->deadline->lt(Carbon::now())))
			return true;
		else
			return false;
	}

	public function status() {
		if ($this->returned_on) {
			if($this->deadline->lt($this->returned_on))
				return "Entregue com Atraso";
			else
				return "Entregue";
		}
		else {
			if($this->deadline->lt(Carbon::now()))
				return "Atrasado";
			else
				return "Emprestado";
		}
	}
}
