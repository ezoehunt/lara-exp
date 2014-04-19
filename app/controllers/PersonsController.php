<?php

// Public view of Members of Congress includes ONLY index and show

use Acme\Repositories\PersonRepoInterface;

class PersonsController extends \BaseController {
	
	protected $person;
	
	public function __construct(PersonRepoInterface $person)
	{
		$this->person = $person;
	}

	/**
	 * @var Agovscores\DbPersonRepo
	*/
	public function index()
	{
		$persons = $this->person->findAll();

		return View::make('persons.index', compact('persons'));
	}

	/**
	 * Display the specified person.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$person = $this->person->find($id);

		return View::make('persons.show', compact('person'));
	}
	
}