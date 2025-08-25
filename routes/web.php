<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('orders')->group(function(){
    Route::get('/', [OrderController::class,'index']);
    Route::get('/{id}', [OrderController::class,'show']);
    Route::post('/', [OrderController::class,'store']);
    Route::patch('/{id}/status', [OrderController::class,'updateStatus']);
    Route::delete('/{id}', [OrderController::class,'destroy']);
});
