<?php namespace Acme\Repositories;

// Contract

interface PersonRepoInterface {
	
	// DBBaseRepo functions
	public function getAll();
	public function getByID($id);
	public function getAllAdminOrder($sort, $order, $paginate);

	// DBPersonRepo functions
	public function getBySlug($slug);
	public function getByBioguide($bioguideid);

	//public function makeDisplayName($person);
	public function prepInsertData($array, $tableName);
	public function countInsertData($array, $tableName, $type);
	public function storePeoplePDO($array);
	

	// OTHER FUNCTIONS NEEDED
	/*
		getfile
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