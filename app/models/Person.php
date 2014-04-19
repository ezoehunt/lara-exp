<?php

class Person extends \Eloquent {

	public $timestamp = true;

    protected $table = 'persons';


	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
	public static function createPersonSlug($id)
	{
		$person = Person::find($id);
		$personSlug = $person->firstname.'_'.$person->lastname;
		$personSlug = Str::lower($personSlug);		
		return $personSlug;
	}

}