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
Route::get('/pdf', 'HomeController@pdf');
Route::get('/home', 'HomeController@index');
Route::post('/home/filter', 'HomeController@filter');

Route::get('generar_pdf/{id}', 'CotizacionController@generar_pdf');

Auth::routes();                                                                         // Autenticación
Route::resource('trabajo', 'TrabajoController');                        // Trabajo
Route::resource('trabajo.pago','PagoController');                       // Pagos
Route::resource('trabajo.costo', 'CostoController');                    // Costos
Route::resource('trabajo.costo.item', 'ItemController');                // Ítemes
Route::resource('trabajo.costo.cotizacion', 'CotizacionController');    // Cotizaciones


// DOCUMENTO
Route::get('trabajo/{id_trabajo}/documento/{id_documento}/download', 'DocumentoController@download');
Route::resource('trabajo.documento','DocumentoController');
Route::get('/documento/nuevo/{id}', 'DocumentoController@create');
Route::get('/documento/editar/{id}', 'DocumentoController@edit');
Route::resource('documento','DocumentoController');


