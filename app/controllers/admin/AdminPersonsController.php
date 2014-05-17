<?php

// Admin view of Members of Congress includes ONLY index and show
// Persons are created/updated/deleted through Govtrack import

use Acme\Repositories\PersonRepoInterface;
use Acme\Utilities\PersonUtilities;

class AdminPersonsController extends AdminController {

	/**
	    * @var PersonRepository
    */
	private $person;
    protected $utilities;
	
	/**
     * injecting PersonRepoInterface as $person
     * injecting PersonUtilities as $utils
    */
	public function __construct(PersonRepoInterface $person, PersonUtilities $utils)
	{
		$this->person = $person;
        $this->utils = $utils;
	}
	
    /**
	 * @var Display all persons
	*/
	public function index()
    {
        $persons = $this->person->getAll();
        
        foreach ($persons as $person) {
            $displayName[] = $this->utils->makeDisplayName($person);
        }
        
        return View::make('admin.persons.index', compact('persons','displayName'));
    }

	/**
	 * Display a single person
	 * @param  string $slug
	 * @return Response
	*/
	public function show($slug)
	{
		$person = $this->person->getBySlug($slug);
        $displayName = $this->utils->makeDisplayName($person);

		return View::make('admin.persons.show', compact('person','displayName'));
	}

}

//EOF