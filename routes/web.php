<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/index', 'HomeController@index')->name('index');
Route::get('/test', 'admin\UserController@create')->name('test');
Route::post('/store', 'admin\UserController@store')->name('store');

//pitches
Route::get('/create-pitches', 'admin\PitchesController@create')->name('create-pitches');
Route::post('/store-pitches', 'admin\PitchesController@store')->name('store-pitches');

