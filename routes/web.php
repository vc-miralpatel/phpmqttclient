<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
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


Route::get('/create',[DemoController::class,'create'])->name('message-create');
Route::post('/store',[DemoController::class,'store'])->name('message-store');

Route::get('/show',[DemoController::class,'show'])->name('message-show');
//Route::get('/test',[DemoController::class,'test']);


Route::get('/subscribe',[DemoController::class,'subscribe'])->name('message-subscribe');
