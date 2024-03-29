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
    return view('todo_list');
});

Route::get('/todos/create', function () {
    return view('todo_create');
});

Route::get('/edit/{id}', function () {
    return view('todo_edit');
});

Route::get('/admin/todo/{id}', [TodoController::class, 'getOneTodo'])->middleware(VerifyCsrfToken::class);
Route::get('/admin/todos', [TodoController::class, 'index'])->middleware(VerifyCsrfToken::class);

Route::redirect('/admin', '/admin/swagger-ui');

Route::post('/admin/store', [TodoController::class, 'store'])->middleware(VerifyCsrfToken::class);

Route::put('/admin/update/{id}', [TodoController::class, 'update'])->middleware(VerifyCsrfToken::class);

Route::delete('/admin/delete/{id}', [TodoController::class, 'delete'])->middleware(VerifyCsrfToken::class);