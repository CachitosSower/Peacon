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
Route::resource('trabajo', 'TrabajoController');

// AUTH
Auth::routes();

// COSTO
Route::resource('trabajo.costo', 'CostoController');

// ITEM
Route::resource('trabajo.costo.item', 'ItemController');

// DOCUMENTO
Route::get('/documento/nuevo/{id}', 'DocumentoController@create');
Route::get('/documento/editar/{id}', 'DocumentoController@edit');
Route::resource('/documento','DocumentoController');



