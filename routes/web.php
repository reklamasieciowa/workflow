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

Route::get('/jobs', 'JobController@index')->name('jobs');
Route::get('/jobs/trash', 'JobController@trash')->name('jobs_deleted');
Route::get('/jobs/{status}', 'JobController@index')->name('jobs_by_status');

Route::get('/job/create', 'JobController@create')->name('job_create');
Route::post('/job/create', 'JobController@store')->name('job_store');

Route::get('/job/{id}', 'JobController@show')->name('job');

Route::get('/job/edit/{id}', 'JobController@edit')->name('job_edit');
Route::post('/job/update/{id}', 'JobController@update')->name('job_update');
Route::get('/job/change-status/{id}', 'JobController@change_status')->name('job_status_change');

Route::get('/job/destroy/{id}', 'JobController@destroy')->name('job_destroy');



Route::get('/task/change-status/{task}', 'TaskController@change_status')->name('task_status_change');



Route::get('/users', 'UserController@index')->name('users');
Route::get('/user/{user}', 'UserController@show')->name('user');