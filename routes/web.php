<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

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

Route::get('/get-token', [AuthController::class, 'getToken']);

Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::get('/orders', [OrderController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});
