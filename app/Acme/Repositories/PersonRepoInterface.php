<?php namespace Acme\Repositories;

interface PersonRepoInterface {
	
	public function findAll();
	
	public function find($id);
	
}