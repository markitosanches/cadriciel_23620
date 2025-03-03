<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

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
})->name('welcome');

Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');
Route::get('/task/{task}', [TaskController::class, 'show'])->name('task.show');
Route::get('/create/task', [TaskController::class, 'create'])->name('task.create');
Route::post('/create/task', [TaskController::class, 'store'])->name('task.store');
Route::get('/edit/task/{task}', [TaskController::class, 'edit'])->name('task.edit');
Route::put('/edit/task/{task}', [TaskController::class, 'update'])->name('task.update');
Route::delete('/task/{task}', [TaskController::class, 'destroy'])->name('task.delete');

Route::get('/completed/task/{completed}', [TaskController::class, 'completed'])->name('task.completed');

Route::get('/query', [TaskController::class, 'query'])->name('task.query');

Route::get('/users', [UserController::class, 'index'])->name('user.index');