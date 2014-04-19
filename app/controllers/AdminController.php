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
		return View::make('admin.dashboard');
    }

}