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

Route::get('/tasks', [
    'uses' => 'TaskController@index',
    'as'   => 'tasks.index'
]);
Route::post('/tasks', 'TaskController@store');
Route::delete('/tasks/{tasks}', 'TaskController@destroy');
Route::get('/tasks/{tasks}/edit', [
    'uses' => 'TaskController@edit',
    'as'   => 'tasks.edit'
]);
Route::put('/tasks/{tasks}', [
    'uses' => 'TaskController@update',
    'as'   => 'tasks.update'
]);

// users
Route::get('/users/{user}/edit', [
    'uses' => 'UserController@edit',
    'as'   => 'users.edit'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
