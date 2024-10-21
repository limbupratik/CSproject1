<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CoinController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/transfer-coins', [CoinController::class, 'transfer'])->middleware('auth'); // Show the transfer form
Route::post('/transfer-coins', [CoinController::class, 'transfer'])->middleware('auth'); // Handle the form submission
Route::get('/transaction-history', [CoinController::class, 'transactionHistory'])->middleware('auth');