<?php namespace Acme\Repositories;

interface PersonRepoInterface {
	
	public function getAll();
	
	public function getByID($id);
	
	// test method
	public function getByLastname($name);
	
	public function getBySlug($slug);
	
			
	
}