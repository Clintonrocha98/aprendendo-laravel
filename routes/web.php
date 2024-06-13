<?php

use Illuminate\Support\Facades\Route;
use Todolist\Task\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'getAllTasks'])->name('home');

Route::post('/', [TaskController::class, 'createTask'])->name('task.create');
Route::delete('/{id}', [TaskController::class, 'deleteTask'])->name('task.delete');
Route::patch('/{id}', [TaskController::class, 'patchTask'])->name('task.patch');
