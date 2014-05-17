<?php namespace Acme\Repositories;

interface PersonRepoInterface {
	
	public function getAll();
	
	public function getByID($id);
	
	// test method
	//public function getByLastname($name);
	
	public function getBySlug($slug);

	// OTHER FUNCTIONS NEEDED
	/*
		getbybioguide
		getbycurrent
		getbyscore
		getbyparty
		getbystate
		getbydistrict
		getbyrole (senator vs rep vs exec)
		getbyseniority (jr, sr, etc)

	*/
	
}

//EOF