<?php

use App\Http\Controllers\DocumentacionController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// /aplicacion
Route::group(['prefix' => 'aplicacion/'], function ($router) {
    // ------------------------------------------------------------
    // api/user/me
    Route::get('documentacion', [DocumentacionController::class, 'index']);
    // ------------------------------------------------------------
});

Auth::routes();
