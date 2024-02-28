<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\VentasController;

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
})->name('welcome');



Route::resource('client', ClientController::class);
Route::resource('direccion', DirectionController::class);
Route::resource('venta', VentasController::class);

Route::get('/ventas/filtrar-por-cliente', 'VentaController@filtrarPorCliente')->name('venta.filtrarPorCliente');



