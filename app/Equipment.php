<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'description'];

	public function loans(){
		return $this->hasMany('App\Loan');
	}

	public function students(){
		return $this->belongsToMany('App\Student', 'loan')->withPivot('deadline', 'loaned_on','returned_on');
	}
}
