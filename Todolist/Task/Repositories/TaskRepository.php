<?php

namespace Todolist\Task\Repositories;

use Todolist\Task\DTO\TaskDTO;
use Todolist\Task\Model\Task;

class TaskRepository
{

  public function createTask(array $payload)
  {
    return Task::create([
      'title' => $payload['title'],
      'body' => $payload['body'],
    ]);
  }
  public function getAllTasks()
  {
    return Task::all();
  }

  public function patchTask(int $id, array $filds)
  {
    $task = Task::findOrFail($id);
   
    $task->update($filds);
  }

  public function deleteTask(int $id)
  {
    return Task::where('id', $id)->delete();
  }

  public function findById(int $id)
  {
    return Task::where('id', $id)->first();
  }
}
