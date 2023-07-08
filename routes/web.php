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



Route::group(['middleware' => config('fortify.middleware', ['api'])], function () {

    Route::get('/home', [DigimonController::class, 'dashboard'])->name('Home');
});