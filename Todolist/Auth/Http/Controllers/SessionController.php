<?php

namespace Todolist\Auth\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages(['email' => 'invalid email']);
        };

        request()->session()->regenerate();

        return redirect('/');

    }
    public function destroy()
    {
        Auth::logout();
        return redirect('/login');
    }
}
