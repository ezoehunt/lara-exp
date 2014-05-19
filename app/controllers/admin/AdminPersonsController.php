<?php

// Admin view of Members of Congress includes ONLY index, show + allpersons
// Persons are created/updated/deleted through Govtrack import

use Acme\Library\Common as Common;
use Acme\Repositories\PersonRepoInterface;
use Acme\Services\MakePersonsService;

class AdminPersonsController extends AdminController {

	/**
	    * @var Acme\Repositories\DBPersonRepo
        * @var Acme\Utilities\PersonUtilities
    */
	private $person;
    private $makePersons;

    public function __construct(PersonRepoInterface $person, MakePersonsService $makePersons)
	{
		$this->person = $person;
        $this->makePersons = $makePersons;
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
        
        $paginate = '50';
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
            // example of injecting service - add to compact vars below
            //$displayName = $this->person->makeDisplayName($person);
        }
        catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $error_msg = 'Oops...looks like there is no Person with slug <i>'.$slug.'</i>. Are you sure you have the right one?';
            return Redirect::route('admin.persons.allpersons')->withErrors($error_msg);
        }

        return View::make('admin.persons.show', compact('person','displayName'), array('bodyclass' => $bodyclass,'pagename' => $pagename,'pagedescription' => $pagedescription));
	}

/*================================================*/
/*              UPLOAD EXTERNAL FILES             */
/*================================================*/
    public function upload() {
        $upload = Common::uploadExtFile('data/persons');
        return $upload;
    }

/*================================================*/
/*         INSERT PERSONS + RELATED MODELS        */
/* Because Historial Related items are HUGE,      */
/* most functions are PDO. Functions with         */
/* smaller inputs use Query Builder.              */
/*================================================*/
    public function addPersons() {
        $countPersons = $this->makePersons->addPersons();

        if ($countPersons['countData'] > 0 AND $countPersons['messageShort'] == 'success') {
            return Redirect::back()->with($countPersons['messageType'], $countPersons['message']);
        }
        elseif ($countPersons['messageType'] == 'error') {
            return Redirect::back()->with('error', $countPersons['message']);
        }
        else {
            return Redirect::back()->with('secondary', '<b>No changes made.</b> No differences between the database and <b>'.$countPersons['countImported'].'</b> People imported');
        }
    }

}

//EOF