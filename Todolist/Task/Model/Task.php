<?php

namespace Todolist\Task\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Todolist\Task\Factory\TaskFactory;

class Task extends Model
{
  use HasFactory;
  protected $table = 'task';

  protected $fillable = [
    'title',
    'body',
    'isFinished',
  ];
  protected static function newFactory(): TaskFactory
  {
    return TaskFactory::new();
  }
}
