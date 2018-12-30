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
Route::get('/jobs/{status}', 'JobController@index')->name('jobs_by_status');

Route::get('/job/{job}', 'JobController@show')->name('job');
Route::get('/job/change-status/{job}', 'JobController@change_status')->name('job_status_change');


Route::get('/task/change-status/{task}', 'TaskController@change_status')->name('task_status_change');
