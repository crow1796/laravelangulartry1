<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function(){
	Route::get('/', 'FileManagerController@index');
	Route::get('/upload', 'FileManagerController@upload');
	Route::get('/file/{id}', 'FileManagerController@show');
	Route::get('/file/{id}/download', 'FileManagerController@downloadFile');

	Route::group(['prefix' => '/api'], function(){
		Route::post('/upload/process', 'FileManagerController@processUpload');
		Route::get('/files', 'FileManagerController@retrieveFiles');
	});
});