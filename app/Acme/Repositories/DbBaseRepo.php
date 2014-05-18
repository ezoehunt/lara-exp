<?php namespace Acme\Repositories;

abstract class DbBaseRepo {
	
	/**
     * @var An Eloquent model
    */
    protected $model;

    function __construct($model)
    {
        $this->model = $model;
    }

    
    public function getAll()
    {
        return $this->model->all();
    }

	public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getAllAdminOrder($sort, $order, $paginate)
    {
        return $this->model->orderBy($sort, $order)->paginate($paginate);
    }

    
	
}

//EOF
