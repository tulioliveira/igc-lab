<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class User extends Model
{
	use Searchable;

	protected $guarded = [];

	public function loans(){
		return $this->hasMany('App\Loan')->orderBy('loaned_on', 'desc');
	}

	public function equipments(){
		return $this->belongsToMany('App\Equipment', 'loans')->withPivot('deadline', 'loaned_on','returned_on');
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
