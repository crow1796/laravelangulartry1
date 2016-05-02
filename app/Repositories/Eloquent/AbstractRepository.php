<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\RepositoryContract;
use Illuminate\Container\Container as App;

abstract class AbstractRepository implements RepositoryContract {

	protected $model;
	protected $app;

	public function __construct(App $app){
		$this->app = $app;
		$this->makeModel();
	}

	public function all($columns = array('*')){
		return $this->model->all();
	}

	public function create($data = array()){
		return $this->model->create($data);
	}

	public function findByIdOrFail($id){
		return $this->model->findOrFail($id);
	}

	protected abstract function model();

	protected function makeModel(){
		$this->model = $this->app($this->model());
	}
}