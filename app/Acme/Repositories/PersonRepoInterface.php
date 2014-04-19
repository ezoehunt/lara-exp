<?php namespace Acme\Repositories;

interface PersonRepoInterface {
	
	public function getAll();
	
	public function getByID($id);
	
	// test method
	public function getByLastname($name);	
	
}