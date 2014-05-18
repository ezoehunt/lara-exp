<?php namespace Acme\Repositories;

interface PersonRepoInterface {
	
	// DBBaseRepo functions
	public function getAll();
	public function getByID($id);
	public function getAllAdminOrder($sort, $order, $paginate);

	// DBPersonRepo functions
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