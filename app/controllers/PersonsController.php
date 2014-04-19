<?php

// Public view of Members of Congress includes ONLY index and show

use Acme\Repositories\PersonRepoInterface;

class PersonsController extends \BaseController {
	
	/**
	    * @var PersonRepository
    */
	private $person;
	
	/**
     * @param PersonRepoInterface $person
    */
	public function __construct(PersonRepoInterface $person)
	{
		$this->person = $person;
	}

	/**
	 * @var Display all persons
	*/
	public function index()
	{
		$persons = $this->person->getAll();

		return View::make('persons.index', compact('persons'));
	}

	/**
	 * Display a single person
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$person = $this->person->getByID($id);

		return View::make('persons.show', compact('person'));
	}
	
}