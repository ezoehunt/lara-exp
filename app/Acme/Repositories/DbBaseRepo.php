<?php namespace Acme\Repositories;

abstract class DbBaseRepo {
	
	/**
	  * Eloquent model
    */
    protected $model;

    /**
     * @param $model
    */
    function __construct($model)
    {
        $this->model = $model;
    }

    /**
	 * @var Person
	*/
	public function getAll()
    {
        return $this->model->all();
    }

	/**
     * Fetch a record by id
     * @param $id
     * @return mixed
    */
    public function getById($id)
    {
        return $this->model->find($id);
    }
	
}

//EOF
