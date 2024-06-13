<?php

namespace Todolist\Task\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Todolist\Task\DTO\TaskDTO;

class CreateTaskRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'title' => ['required', 'string'],
      'body' => ['required', 'string'],
    ];
  }
}