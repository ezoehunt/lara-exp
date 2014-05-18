<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::resource('/persons', 'PersonsController');


/*------ ADMIN --------*/
Route::get('/admin', array('as' =>'admin', 'uses' => 'AdminController@dashboard'))->before('admin_auth');



Route::get('/admin/persons/allpersons', array('as' => 'admin.persons.allpersons', 'uses' => 'AdminPersonsController@allpersons'));
Route::resource('/admin/persons', 'AdminPersonsController');

