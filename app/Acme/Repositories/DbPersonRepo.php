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
     * @param Product $model
    */
    function __construct(Person $model)
    {
        $this->model = $model;
    }

	/* MODEL-SPECIFIC FUNCTIONS */
	// test method
	public function getBySlug($slug)
	{
		return $this->model->where('slug', '=', $slug)->firstOrFail();
	}
	
	public function getByLastname($lastname)
	{
		return $this->model->where('lastname', '=', $lastname)->firstOrFail();
	}
	
}
