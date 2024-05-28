<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
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
Route::prefix('login')->name('login')->controller(AuthController::class)->group(function(){
    Route::get('/','login',[\App\Http\Controllers\AuthController::class,'login'])->name('login');
    Route::post('/','doLogin',[\App\Http\Controllers\AuthController::class,'doLogin']);
    Route::delete('/','logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->controller(IndexController::class)->middleware('auth')->group(function(){
     Route::get('/','index')->name('index');
});
