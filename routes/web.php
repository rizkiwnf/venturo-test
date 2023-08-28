<?php

use App\Http\Controllers\FoodController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/intermediate/', [FoodController::class, 'index']);
Route::get('/intermediate/', [FoodController::class, 'getYear']);
Route::get('/intermediate/menu', [FoodController::class, 'getMenu']);
Route::get('/intermediate/transaksi/{year}', [FoodController::class, 'getTransaksi']);
Route::get('/intermediate/download/{namaFile}', [FoodController::class, 'downloadFile']);

Route::get('/intermediate/transaksi', [FoodController::class, 'getData']);