<?php

namespace Todolist\Task\Factory;

use Todolist\Task\Model\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
  protected $model = Task::class;

  public function definition(): array
  {
    return [
      'title' => "task foda",
      'body' => "tem q fazer varias paradas ae mano",
      'isFinished' => false,
    ];
  }
}
