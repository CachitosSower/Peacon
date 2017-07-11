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

Route::get('trabajo/prueba', 'WorkController@show_list');
Route::get('trabajo/prueba/costos/nuevo', 'WorkController@new_cost')->name('new-cost');
Route::get('/', 'WorkController@show_list');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
