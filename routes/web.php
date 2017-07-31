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

// INICIO
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');
Route::post('/home/filter', 'HomeController@filter');

// TRABAJO
Route::get('trabajos', 'HomeController@index');
Route::get('trabajo/costos/nuevo', 'WorkController@new_cost')->name('new-cost');
Route::get('trabajo/nuevo', 'WorkController@create');
Route::get('trabajo/modificar/{id}', 'WorkController@edit');
Route::post('trabajo/store', 'WorkController@store');
Route::post('trabajo/update/{id}', 'WorkController@update');
Route::get('trabajo/{id}', 'WorkController@index');

// AUTH
Auth::routes();

// COSTO

// DOCUMENTO
Route::get('/documento/nuevo/{id}', 'DocumentoController@create');
Route::get('/documento/editar/{id}', 'DocumentoController@edit');
Route::resource('/documento','DocumentoController');

// ITEMES
Route::get('/item/costo/{id_costo}', 'ItemController@index');
Route::resource('item', 'ItemController');
