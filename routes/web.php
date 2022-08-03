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

//Route::get('/', function () {
//    return view('auth.login');
//});


Auth::routes();
Route::get('/', 'HomeController@index')->name('index');

Route::get('/home', 'HomeController@index')->name('index');
Route::get('/service', 'HomeController@service')->name('service');
Route::get('/product', 'HomeController@product')->name('product');
Route::get('/detail-pitches/{id}', 'HomeController@detail')->name('detail-pitches');
Route::get('add-to-cart/{id}', [HomeController::class, 'addToCart'])->name('add.to.cart');

Route::get('/show', 'HomeController@show')->name('show');
Route::get('/test', 'admin\UserController@create')->name('test');
Route::post('/store', 'admin\UserController@store')->name('store');

//pitches
Route::get('/create-pitches', 'admin\PitchesController@create')->name('create-pitches');
Route::post('/store-pitches', 'admin\PitchesController@store')->name('store-pitches');

// product
Route::get('/add-product', 'admin\ProductController@create')->name('add-product');
Route::post('/store-product', 'admin\ProductController@store')->name('store-product');
Route::get('/list-product', 'admin\ProductController@list')->name('list-product');
Route::get('/delete-product/{id}', 'admin\ProductController@delete')->name('delete-product');
Route::get('/edit-product/{id}', 'admin\ProductController@edit')->name('edit-product');
Route::post('/update-product/{id}', 'admin\ProductController@update')->name('update-product');

