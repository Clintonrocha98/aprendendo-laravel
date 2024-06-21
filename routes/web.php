<?php

use Illuminate\Support\Facades\Route;
use Todolist\Task\Http\Controllers\TaskController;
use Todolist\Auth\Http\Controllers\RegisteredUserController;
use Todolist\Auth\Http\Controllers\SessionController;

Route::controller(TaskController::class)->middleware('auth')->group(function () {
  Route::get('/', 'getAllTasks')->name('home');
  Route::post('/', 'createTask')->name('task.create');
  Route::delete('/{id}', 'deleteTask')->name('task.delete');
  Route::patch('/{id}', 'patchTask')->name('task.patch');
});

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);

