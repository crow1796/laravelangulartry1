<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Storage;
use App\FileEntry;
use File;
use Illuminate\Http\Response;
use App\Repositories\Eloquent\FileRepository;
use App\FileManager\FileManager;

class FileManagerController extends Controller
{

    protected $fileRepository;
    protected $fileManager;

    public function __construct(FileRepository $fileRepository, FileManager $fileManager){
        $this->fileRepository = $fileRepository;
        $this->fileManager = $fileManager;
    }

    public function index(){
    	return view('file-manager.index', ['title' => 'File Manager']);
    }

    public function upload(){
    	return view('file-manager.upload', ['title' => 'Upload files']);
    }

    public function processUpload(Request $request){
    	$file = $request->file('file_upload');;
        $uploaded = $this->fileManager->upload($file);

        $data = array(
            'filename' => $file->getFilename() . '.' . $extension,
            'original_filename' => $file->getClientOriginalName(),
            'mime' => $file->getClientMimeType(),
            'date_upload' => \Carbon\Carbon::now()->format('Y-m-d'),
            );

        $saved = $fileRepository->create($data);

    	// $entry = new FileEntry();
    	// $entry->filename = $file->getFilename() . '.' . $extension;
    	// $entry->original_filename = $file->getClientOriginalName();
    	// $entry->mime = $file->getClientMimeType();
    	// $entry->date_upload = \Carbon\Carbon::now()->format('Y-m-d');
    	// $saved = $entry->save();

    	return ($uploaded && $saved) ? 'Uploaded Successfully!' : 'Uploading Failed!';
    }

    public function show($id){
    	$entry =  $this->fileRepository->findByIdOrFail($id);

        return $this->fileManager->showFileFrom($entry, 'uploaded_files');
    }

    public function downloadFile($id){
    	$entry = $this->fileRepository->findByIdOrFail($id);

        return $this->fileManager->downloadFrom($entry, 'uploaded_files');
    }

    public function retrieveFiles(){
    	$files = $this->fileRepository->all();

    	return $files->toJson();
    }
}
