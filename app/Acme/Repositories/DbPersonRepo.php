<?php namespace Acme\Repositories;

// Eloquent-specific implementation

use Person;

class DbPersonRepo implements PersonRepoInterface {
	
	public function findAll() 
	{
		return Person::all();
	}
	
	public function find($id)
	{
		return Person::findOrFail($id);
	}
	
}
