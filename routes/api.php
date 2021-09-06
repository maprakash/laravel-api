<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Login Route
Route::post('/login', 'API\AuthController@login');

//All users - Team access
Route::get('/teams', 'API\TeamController@index');
//Route::get('/teams/{column}/{id}', 'API\TeamController@show')->where(['column' => '[a-z]+', 'id' => '[0-9]+' ]);
Route::get('/teams/{id}', 'API\TeamController@showByID')->where(['id' => '[0-9]+' ]);
Route::get('/teams/name/{name}', 'API\TeamController@showByName');

//All users - Player access
Route::get('/players', 'API\PlayerController@index');
//Route::get('/teams/{column}/{id}', 'API\TeamController@show')->where(['column' => '[a-z]+', 'id' => '[0-9]+' ]);
Route::get('/players/{id}', 'API\PlayerController@showByID')->where(['id' => '[0-9]+' ]);
Route::get('/players/name/{name}', 'API\PlayerController@showByName');

//Restricted Access to Authorized users
Route::group(['middleware'=> 'auth:api'], function(){
    Route::post('/teams', 'API\TeamController@store');
    Route::post('/teams/{id}', ['uses' => 'API\TeamController@update', 'middleware' => 'PostToPatch'])->where(['id' => '[0-9]+' ]);
    Route::patch('/teams/{id}','API\TeamController@update')->where(['id' => '[0-9]+' ]);
    Route::delete('/teams/{id}', 'API\TeamController@destroy')->where(['id' => '[0-9]+' ]);

    Route::post('players', 'API\PlayerController@store');
    Route::post('players/{id}', ['uses' => 'API\PlayerController@update', 'middleware' => 'PostToPatch'])->where(['id' => '[0-9]+' ]);
    Route::patch('players/{id}','API\PlayerController@update')->where(['id' => '[0-9]+' ]);
    Route::delete('players/{id}', 'API\PlayerController@destroy')->where(['id' => '[0-9]+' ]);

});







