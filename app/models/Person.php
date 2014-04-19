<?php

class Person extends \Eloquent {

	public $timestamp = true;

    protected $table = 'persons';


	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
	public static $sluggable = array(
        'build_from' 	=>	array('firstname','lastname'),
        'save_to'    	=>	'slug',
		'on_update'		=>	true
    );

}