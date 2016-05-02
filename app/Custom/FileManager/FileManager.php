<?php

namespace App\FileManager;
use App\FileManager\Uploader\UploaderContract;
use Illuminate\Http\Response;
use Storage;

class FileManager implements UploaderContract, DownloaderContract{

	public function __construct(){

	}

	public function upload($file){
    	$extension = $file->getClientOriginalExtension();
    	$moved = $file->move(storage_path('/files'), $file->getFilename() . '.' . $extension);

    	return $moved;
	}

	public function showFileFrom($entry, $from = ''){
		$file = Storage::disk($from)->get($entry->filename);

		return (new Response($file, 200))
	          		->header('Content-Type', $entry->mime);
	}

	public function downloadFrom($entry, $from = ''){
		$file = Storage::disk($from)->get($entry->filename);

		return (new Response($file, 200))
				->header('Content-Disposition', 'attachment; filename=\"' . $entry->original_filename . '\"')
	              ->header('Content-Type', 'application/force-download')
	              ->header('Connection', 'close')
	              ->header('Pragma', 'no-cache');
	}
}