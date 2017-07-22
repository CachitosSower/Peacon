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

Route::get('trabajo', 'WorkController@show_list');
Route::get('trabajo/costos/nuevo', 'WorkController@new_cost')->name('new-cost');
Route::get('trabajo/nuevo', 'WorkController@create');
Route::get('trabajo/modificar/{id}', 'WorkController@edit');
Route::post('trabajo/store', 'WorkController@store');
Route::post('trabajo/update/{id}', 'WorkController@update');
Route::get('trabajo/{id}', 'WorkController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
