<?php

namespace Todolist\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Todolist\User\Model\User;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required'],
            'email' => ['required', 'exists:users, email'],
            'password' => ['required', Password::min(8), 'confirmed']
        ]);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/');
    }
}
