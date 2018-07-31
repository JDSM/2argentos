<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/articulo','ArticuloControlloer');
Route::resource('almacen/stock','StockController');
Route::resource('inicio/inicio','InicioController');
Route::resource('seguridad/usuario','UsuarioController');
Route::resource('ventas/cliente','ClienteController');
Route::resource('ventas/venta','VentaController');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/{slug?}','HomeController@index');

