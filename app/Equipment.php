<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Scout\Searchable;
use App\Loan;

class Equipment extends Model
{
	use Searchable;

	protected $guarded = [];

	public function loans(){
		return $this->hasMany('App\Loan')->orderBy('loaned_on', 'desc');
	}

	public function users(){
		return $this->belongsToMany('App\User', 'loans')->withPivot('deadline', 'loaned_on','returned_on');
	}

	public function isLoaned() {
		try {
			$loan = Loan::where('returned_on', '=', null)->where('equipment_id', '=', $this->id)->firstOrFail();
		} catch (ModelNotFoundException $ex) {
			return false;
		}
		return true;
	}

	/**
	 * Get the indexable data array for the model.
	 *
	 * @return array
	 */
	public function toSearchableArray()
	{
		$array = $this->toArray();

		return $array;
	}
}
