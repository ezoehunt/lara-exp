<?php

// Admin view of Members of Congress includes ONLY index, show + allpersons
// Persons are created/updated/deleted through Govtrack import

use Acme\Repositories\PersonRepoInterface;
use Acme\Utilities\PersonUtilities;

class AdminPersonsController extends AdminController {

	/**
	    * @var Acme\Repositories\DBPersonRepo
        * @var Acme\Utilities\PersonUtilities
    */
	private $person;
    private $utilities;
	
	public function __construct(PersonRepoInterface $person, PersonUtilities $utils)
	{
		$this->person = $person;
        $this->utils = $utils;
	}


    // The make/update page for Persons
    public function index()
    {
        $bodyclass = ['admin','persons'];
        $pagename = 'Manage People';     
        $pagedescription = 'Manage People';

        return View::make('admin.persons.index', array('bodyclass' => $bodyclass, 'pagename' => $pagename, 'pagedescription' => $pagedescription));
    }

    // List of all Persons
	public function allpersons()
    {
        $bodyclass = ['admin','persons'];
        $pagename = 'View All People';     
        $pagedescription = 'View All People';
        
        $paginate = '5';
        $sort = Input::get('sort');
        $order = Input::get('order');
        
        if ($sort && $order) {
            $persons = $this->person->getAllAdminOrder($sort, $order, $paginate);
        } 
        else {
            $persons = $this->person->getAllAdminOrder('id', 'asc', $paginate);
        }

        return View::make('admin.persons.allpersons', compact('persons','sort','order','paginate'), array('bodyclass' => $bodyclass, 'pagename' => $pagename, 'pagedescription' => $pagedescription));
    }

	// An individual Person
	public function show($slug)
	{
		$bodyclass = ['admin','persons'];
        $pagename = 'View a Person';     
        $pagedescription = 'View a Person';

        try {
            $person = $this->person->getBySlug($slug);
            $displayName = $this->utils->makeDisplayName($person);
        }
        catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $error_msg = 'Oops...looks like there is no Person with slug <i>'.$slug.'</i>. Are you sure you have the right one?';
            return Redirect::route('admin.persons.allpersons')->withErrors($error_msg);
        }
        return View::make('admin.persons.show', compact('person','displayName'), array('bodyclass' => $bodyclass,'pagename' => $pagename,'pagedescription' => $pagedescription));
	}

}

//EOF