<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Storage;
use App\FileEntry;
use File;
use Illuminate\Http\Response;

class FileManagerController extends Controller
{
    public function index(){
    	return view('file-manager.index', ['title' => 'File Manager']);
    }

    public function upload(){
    	return view('file-manager.upload', ['title' => 'Upload files']);
    }

    public function processUpload(Request $request){
    	$file = $request->file('file_upload');
    	$extension = $file->getClientOriginalExtension();
    	$moved = $file->move(storage_path('/files'), $file->getFilename() . '.' . $extension);
    	$entry = new FileEntry();
    	$entry->filename = $file->getFilename() . '.' . $extension;
    	$entry->extension = $extension;
    	$entry->original_filename = $file->getClientOriginalName();
    	$entry->mime = $file->getClientMimeType();
    	$entry->date_upload = \Carbon\Carbon::now()->format('Y-m-d');
    	$saved = $entry->save();
    	return ($moved && $saved) ? 'Uploaded Successfully!' : 'Uploading Failed!';
    }

    public function show($id){
    	$entry = FileEntry::findOrFail($id);
		$file = Storage::disk('uploaded_files')->get($entry->filename);

		return (new Response($file, 200))
              ->header('Content-Type', $entry->mime);
    }

    public function downloadFile($id){
    	$entry = FileEntry::findOrFail($id);
		$file = Storage::disk('uploaded_files')->get($entry->filename);
		return (new Response($file, 200))
				->header('Content-Disposition', 'attachment; filename=\"' . $entry->original_filename . '\"')
              ->header('Content-Type', 'application/force-download')
              ->header('Connection', 'close')
              ->header('Pragma', 'no-cache');
    }

    public function retrieveFiles(){
    	$files = \App\FileEntry::all();

    	return $files->toJson();
    }
}
