<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DigimonController;

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


Route::group(['middleware' => ['web', 'auth', 'verified']], function () {
    Route::get('/home', [DigimonController::class, 'dashboard'])->name('home');
    Route::get('/digimons', [DigimonController::class, 'getDigimons'])->name('digimons.list');
    Route::get('detail-digimons/{id}', [DigimonController::class, 'getDetailDigimon'])->name('digimons.detail.list');
});
