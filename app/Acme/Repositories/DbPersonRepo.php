<?php namespace Acme\Repositories;

// Eloquent-specific implementation

use Person;
use Acme\Repositories\DbBaseRepo;

class DbPersonRepo extends DbBaseRepo implements PersonRepoInterface {
	
	/**
     * @var Person
    */
    protected $model;

    /**
     * @param Person $model
    */
    function __construct(Person $model)
    {
        $this->model = $model;
    }

	
	// test method
	/*public function getByLastname($lastname)
	{
		return $this->model->where('lastname', '=', $lastname)->firstOrFail();
	}*/
	
    
	/* MODEL-SPECIFIC FUNCTIONS */
    public function getBySlug($slug)
	{
		return $this->model->where('slug', '=', $slug)->firstOrFail();
	}
	
	
	
}

//EOF