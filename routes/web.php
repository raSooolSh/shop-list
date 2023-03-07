<?php

use App\Http\Controllers\mainController;
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
})->name('home');

Route::get('/list-show',[mainController::class,'showList'])->name('list-show');
Route::post('/list-show',[mainController::class,'submitList']);
Route::get('/list-create',[mainController::class,'createList'])->name('list-create');
Route::post('/list-create',[mainController::class,'sumbitCreate']);
Route::get('/add-product',[mainController::class,'addProduct'])->name('add-product');
Route::post('/add-product',[mainController::class,'sumbitAddProduct']);
