<?php

// Admin view of Members of Congress includes ONLY index and show
// Persons are created/updated/deleted through Govtrack import

use Acme\Repositories\PersonRepoInterface;

class AdminPersonsController extends AdminController {

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

        return View::make('admin.persons.index', compact('persons'));
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

		return View::make('admin.persons.show', compact('person'));
	}

}
