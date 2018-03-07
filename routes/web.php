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

//Home
Route::get('/', function () {
    return view('welcome');
});

//Pages
Route::group(['prefix' => '/'], function() {
    //
});

//Application
Route::group(['prefix' => 'app'], function() {
    Route::get('/', function() {
        return view('app.sign');
    });

    Route::get('/me', function() {
        return view('app.me');
    });

    Route::get('/install', function() {
        return view('app.install');
    });
});