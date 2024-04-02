<?php

use App\Models\Productos;
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
    return view('home');
});

Route::get('/catalogo/', function () {
    return view('catalogo',[
        'productos' => Productos::all(),
    ]);
});

Route::get('/catalogo/{producto?}', function($slug){
    return view('producto', [
        'producto' => Productos::findOrFail($slug)
    ]);
});

Route::get('/inicio', function () {
    return view('home');
});