<?php

namespace App\Repositories\Contracts;

interface RepositoryContract {
	public function all($columns = array('*'));
	public function create($data = array());
	public function findByIdOrFail($id);
}