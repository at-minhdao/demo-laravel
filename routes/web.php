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


Route::group(['prefix' => 'tasks'], function() {
    Route::get('', [
        'uses' => 'TaskController@index',
        'as'   => 'tasks.index'
    ]);
    Route::post('', [
        'uses' => 'TaskController@store',
        'as'   => 'tasks.store',
    ]);
    Route::delete('{task}', [
        'uses' => 'TaskController@destroy',
        'as'   => 'tasks.destroy',
    ]);
    Route::get('{task}/edit', [
        'uses' => 'TaskController@edit',
        'as'   => 'tasks.edit'
    ]);
    Route::put('{task}', [
        'uses' => 'TaskController@update',
        'as'   => 'tasks.update'
    ]);
});

// users
Route::group(['namespace' => 'Auth'], function() {
    Route::group(['prefix' => 'users'], function() {
        Route::get('{user}/edit', [
            'uses' => 'UserController@edit',
            'as'   => 'users.edit'
        ]);        
        Route::put('{user}', [
            'uses' => 'UserController@update',
            'as'   => 'users.update',
        ]); 
    });
    
    Route::group(['prefix' => 'admin'], function() {
        Route::get('', [
            'uses' => 'AdminController@index',
            'as'   => 'admin.index',
        ]);
        Route::get('login', [
            'uses' => 'AdminLoginController@index',
            'as'   => 'admin.login',
        ]);
        Route::post('login', [
            'uses' => 'AdminLoginController@login',
            'as'   => 'admin.login',
        ]);
    });
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
