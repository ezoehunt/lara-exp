<?php

class Person extends \Eloquent {

	public $timestamp = true;

    protected $table = 'persons';

	protected $guarded = array('id', 'bioguideid');

	public static $rules = [
		'bioguideid'	=>	'required|unique',
        'govtrackid'   	=>	'required|unique',
        'slug'      	=>	'required|unique',
        'firstname'   	=>	'required',
        'lastname'    	=>	'required'
	];

	protected $fillable = [];
	
	public static $sluggable = array(
        'build_from' 	=>	array('firstname','lastname'),
        'save_to'    	=>	'slug',
		'on_update'		=>	true
    );
	
	

}