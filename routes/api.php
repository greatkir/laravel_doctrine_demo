<?php

use Illuminate\Http\Request;

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

Route::get('jobcount', 'JobController@count');
Route::resource('job', 'JobController', array('only' => array('index', 'show')));
Route::resource('job/offset/{id}', 'JobController', array('only' => array('index')));

Route::resource('brandlist', 'BrandController', array('only' => array('index')));
Route::resource('locationlist', 'LocationController', array('only' => array('index')));