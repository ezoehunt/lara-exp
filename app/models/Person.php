<?php

class Person extends \Eloquent {

    public $timestamp = true;

    protected $table = 'persons';

	protected $guarded = array('id', 'bioguideid');
    protected $fillable = [];

	public static $rules = [
		'bioguideid'	=>	'required|unique',
        'govtrackid'   	=>	'required|unique',
        'slug'      	=>	'required|unique',
        'firstname'   	=>	'required',
        'lastname'    	=>	'required'
	];

    public static $mapPersons = array (
        'bioguide'          => 'bioguideid',
        'first'             => 'firstname', 
        'middle'            => 'middlename',                    
        'last'              => 'lastname',                      
        'suffix'            => 'namemod',
        'official_full'     => 'name',
        'wikipedia'         => 'wikipediaid',
        'govtrack'          => 'govtrackid',
        'votesmart'         => 'pvsid',
        'opensecrets'       => 'osid',
        'cspan'             => 'cspanid',
        'maplight'          => 'maplightid',
        'lis'               => 'lisid',
        'washington_post'   => 'wapoid',
        'icpsr'             => 'icpsrid',
        'icpsr_prez'        =>  'icpsrprezid'
    );

    public static $arrayStructurePersons = array (
        'bioguideid'        =>  'null',
        'firstname'         =>  'null',
        'middlename'        =>  'null',
        'lastname'          =>  'null',
        'namemod'           =>  'null',
        'name'              =>  'null',
        'slug'              =>  'null',
        'nickname'          =>  'null',                     
        'sortname'          =>  'null',
        'birthday'          =>  '0000-00-00',
        'gender'            =>  '0',
        'religion'          =>  'null',
        'twitterid'         =>  'null',
        'facebookid'        =>  'null',
        'youtubeid'         =>  'null',
        'wikipediaid'       =>  'null',
        'govtrackid'        =>  'null',
        'pvsid'             =>  'null',
        'osid'              =>  'null',
        'cspanid'           =>  '0',
        'maplightid'        =>  'null',
        'lisid'             =>  'null',
        'fec'               =>  'null',
        'wapoid'            =>  'null',
        'icpsrid'           =>  'null',
        'icpsrprezid'       =>  'null',
        'execflag'          =>  'null'
    );

}

// EOF