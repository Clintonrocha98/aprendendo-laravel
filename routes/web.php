<?php

use Illuminate\Support\Facades\Route;
use Todolist\Task\Http\Controllers\TaskController;


Route::controller(TaskController::class)->group(function () {
  Route::get('/', 'getAllTasks')->name('home');
  Route::post('/', 'createTask')->name('task.create');
  Route::delete('/{id}', 'deleteTask')->name('task.delete');
  Route::patch('/{id}', 'patchTask')->name('task.patch');
});

