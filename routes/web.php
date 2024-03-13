<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Middleware\VerifyCsrfToken;

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

Route::get('/todos', [TodoController::class, 'index']);
Route::post('/store', [TodoController::class, 'store'])->middleware(VerifyCsrfToken::class);
Route::put('/update/{id}', [TodoController::class, 'update'])->middleware(VerifyCsrfToken::class);
Route::delete('/delete/{id}', [TodoController::class, 'delete'])->middleware(VerifyCsrfToken::class);