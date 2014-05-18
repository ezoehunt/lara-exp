<?php

class AdminController extends BaseController {
	
	public function __construct()
    {
        // Apply the admin auth filter
        //$this->beforeFilter('admin-auth');
    }

    public function dashboard()
    {
		$bodyclass = ['admin','dashboard'];
        $pagename = 'Dashboard';     
        $pagedescription = 'Dashboard';

		return View::make('admin.dashboard', array('bodyclass' => $bodyclass, 'pagename' => $pagename, 'pagedescription' => $pagedescription));
    }

}

//EOF