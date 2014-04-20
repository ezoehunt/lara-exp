<?php

// Admin view of Members of Congress includes ONLY index and show
// Persons are created/updated/deleted through Govtrack import

use Acme\Repositories\PersonRepoInterface;
use Acme\Utilities;

class AdminPersonsController extends AdminController {

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

        return View::make('admin.persons.index', compact('persons'));
    }

	/**
	 * Display a single person
	 * @param  string $slug
	 * @return Response
	*/
	public function show($slug)
	{
		$person = $this->person->getBySlug($slug);

		return View::make('admin.persons.show', compact('person'));
	}

}

//EOF