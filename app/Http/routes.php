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

Route::get('/', function() {
	return view('app');
});

Route::group(['prefix' => 'api'], function() {

	Route::post('oauth/access_token', function() {
		return Response::json(Authorizer::issueAccessToken());
	});

	Route::group(['middleware' => 'oauth'], function() {
		Route::resource('clients', 'ClientController', ['except' => ['create', 'edit']]);
		Route::resource('projects', 'ProjectController', ['except' => ['create', 'edit']]);

		Route::group(['middleware' => 'check-project-permission'], function() {
			Route::resource('projects/{id}/notes', 'ProjectNoteController', ['except' => ['create', 'edit']]);

			Route::resource('projects/{id}/files', 'ProjectFileController', ['except' => ['create', 'edit']]);

			Route::resource('projects/{id}/tasks', 'ProjectTaskController', ['except' => ['create', 'edit']]);
		});

		Route::get('projects/{id}/files/{idFile}/download', 'ProjectFileController@download');

		Route::get('user/authenticated', 'UserController@getAuthenticated');
	});

	
});
