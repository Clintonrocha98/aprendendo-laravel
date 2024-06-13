<?php

namespace Todolist\Task\Service;

use Todolist\Task\DTO\TaskDTO;
use Todolist\Task\Repositories\TaskRepository;

class TaskService
{

  public function __construct(private readonly TaskRepository $taskRepository)
  {
  }

  public function allTasks()
  {
    return $this->taskRepository->getAllTasks();
  }

  public function createTask(array $task)
  {
    return $this->taskRepository->createTask($task);
  }

  public function patchTask(int $id, array $fields)
  {
    $this->taskRepository->patchTask($id, $fields);
  }

  public function deleteTask(int $id)
  {

    $existTask = $this->taskRepository->findById($id);

    if (!$existTask) {
      throw new \Exception('task não existe');
    }

    return $this->taskRepository->deleteTask($id);
  }

}
