<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileEntry extends Model
{
    protected $table = 'file_entries';
    public $timestamps = false;
    protected $fillable = [
    	'filename',
    	'original_filename',
    	'mime',
    	'date_upload',
    	'extension',
    ];
}
