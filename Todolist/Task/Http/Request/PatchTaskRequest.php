<?php

namespace Todolist\Task\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class PatchTaskRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'title' => ['nullable', 'string'],
      'body' => ['nullable', 'string'],
      'isFinished' => ['nullable', 'boolean'],
    ];
  }
}