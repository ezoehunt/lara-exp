<?php namespace Acme\Repositories;

// Eloquent-specific implementation

use Person;
use Acme\Repositories\DbBaseRepo;

class DbPersonRepo extends DbBaseRepo implements PersonRepoInterface {
	
	/**
     * @var Product
    */
    protected $model;

    /**
     * @param Product $model
    */
    function __construct(Person $model)
    {
        $this->model = $model;
    }
	
}
