<?php

namespace Todolist\Task\Http\Controllers;

use App\Http\Controllers\Controller;
use Todolist\Task\Http\Request\CreateTaskRequest;
use Todolist\Task\Http\Request\PatchTaskRequest;
use Todolist\Task\Service\TaskService;

class TaskController extends Controller
{
  public function __construct(private readonly TaskService $taskService)
  {
  }

  public function getAllTasks()
  {
    $all = $this->taskService->allTasks();

    return view('todolist', compact('all'));
  }
  public function createTask(CreateTaskRequest $request)
  {
    $payload = $request->validated();

    $this->taskService->createTask($payload);

    return redirect()->route('home');
  }

  public function patchTask(PatchTaskRequest $request, int $id)
  {
    $payload = $request->validated();
   
    $this->taskService->patchTask($id, $payload);

    return redirect()->route('home');
  }

  public function deleteTask(int $id)
  {
    $this->taskService->deleteTask($id);

    return redirect()->route('home');
  }
}
