<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('jobs')->group(function () {
	Route::get('', 'JobController@index')->name('jobs');
	Route::get('trash', 'JobController@trash')->name('jobs_deleted');
	Route::get('{status}', 'JobController@index')->name('jobs_by_status');
});

Route::prefix('job')->group(function () {
	Route::get('create', 'JobController@create')->name('job_create');
	Route::post('create', 'JobController@store')->name('job_store');

	Route::get('{id}', 'JobController@show')->name('job');

	Route::get('edit/{id}', 'JobController@edit')->name('job_edit');
	Route::post('update/{id}', 'JobController@update')->name('job_update');
	Route::get('change-status/{id}', 'JobController@change_status')->name('job_status_change');

	Route::get('destroy/{id}', 'JobController@destroy')->name('job_destroy');
});

Route::prefix('task')->group(function () {
	Route::get('change-status/{task}', 'TaskController@change_status')->name('task_status_change');
});

Route::prefix('users')->group(function () {
	Route::get('', 'UserController@index')->name('users');
	Route::get('{user}', 'UserController@show')->name('user');
});