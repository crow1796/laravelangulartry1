<?php

namespace App\FileManager\Uploader;
use Storage;

interface UploaderContract {
	public function upload($file, $path = '');
	public function success();
}
