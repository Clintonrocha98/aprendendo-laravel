<?php

namespace Todolist\Task\Repositories;

use Todolist\Task\DTO\TaskDTO;
use Todolist\Task\Model\Task;

class TaskRepository
{

  public function createTask(array $payload)
  {
    return Task::create($payload);
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
    return Task::findOrFail($id)->delete();
  }


}
