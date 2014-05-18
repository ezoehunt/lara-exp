<?php namespace Acme\Repositories;

// DB Eloquent-specific implementation

use Person;
use Acme\Repositories\DbBaseRepo;

class DbPersonRepo extends DbBaseRepo implements PersonRepoInterface {
	
	/**
     * @var Person
    */
    protected $model;

    function __construct(Person $model)
    {
        $this->model = $model;
    }
	

	/* Model-specific Functions */
    public function getBySlug($slug)
	{
		return $this->model->where('slug', '=', $slug)->firstOrFail();
	}
    
	
	
	
}

//EOF