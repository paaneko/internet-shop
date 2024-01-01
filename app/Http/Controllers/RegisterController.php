<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('pages.register');
    }

    public function store(): RedirectResponse
    {
        $credentials = request()->validate([
            'name' => 'required|max:55|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:7',
        ]);

        $user = User::create($credentials);

        auth()->login($user);

        return redirect('/')->with('success', 'Your account has been created.');
    }
}
