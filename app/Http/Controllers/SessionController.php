<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SessionController extends Controller
{
    public function create(): View
    {
        return view('pages.login');
    }

    /**
     * @throws ValidationException
     */
    public function store(): ?RedirectResponse
    {
        $credentials = request()->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|max:255|min:7',
        ]);

        if (auth()->attempt($credentials)) {
            redirect('/')->with('success', 'Successfully logged in.');
        }

        throw ValidationException::withMessages(
            ['password' => 'Your provided credentials does not match our records']
        );
    }

    public function destroy(): RedirectResponse
    {
        auth()->logout();

        return redirect('/')->with('success', 'Successfully logged out.');
    }
}
