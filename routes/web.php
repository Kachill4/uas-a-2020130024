<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
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

// Route::get('/', function () {return view('welcome');});
Route::get('/', [AppController::class, 'index'])->name('home.index');
Route::resource('menus', MenuController::class);
Route::resource('order', OrderController::class);

