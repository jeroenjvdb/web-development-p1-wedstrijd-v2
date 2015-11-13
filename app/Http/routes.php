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



Route::get('/', ['as' => 'home', 'uses' => 'MainController@home']);

route::get('/test',['as' => 'test', 'uses'=>'MainController@test']);
route::post('/test', ['uses' => 'MainController@postTest']);
route::get('/test/ajax', ['uses' => 'MainController@testajax']);

Route::post('/facebooklogin', ['as' => 'facebooklogin', 'uses' => 'Auth\AuthController@facebooklogin']);
Route::post('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@login']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
Route::post('/register', ['as' => 'register', 'uses' => 'Auth\AuthController@postRegister']);

Route::get('/competition', ['as' => 'competition', 'uses' => 'MainController@competition']);
Route::post('/competition', ['uses' => 'MainController@postCompetition']);
Route::get('/competition/others', ['as' => 'otherCompetitors', 'uses' => 'MainController@otherCompetitors']);
Route::get('/competitor/{id}', ['as' => 'competitor', 'uses' => 'MainController@competitor']);
Route::get('/competitor/{id}/vote', ['as' => 'vote', 'uses' => 'MainController@vote']);
Route::get('/competitor/{id}/unvote', [ 'as' => 'unvote', 'uses' => 'MainController@unVote']);

Route::get('/managment', [ 'as' => 'managment', 'uses' => 'MainController@managment']);
Route::get('managment/export/all', ['as' => 'exportAll', 'uses' => 'MainController@exportAll']);
Route::get('managment/delete/{id}', ['as' => 'deleteCompetitor', 'uses' => 'MainController@deleteCompetitor']);