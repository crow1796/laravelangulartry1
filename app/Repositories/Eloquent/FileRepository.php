<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Eloquent\AbstractRepository;

class FileRepository extends AbstractRepository {
	protected function model(){
		return 'App\FileEntry';
	}
}