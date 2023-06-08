<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function create()
    {
        return Inertia::render('Application/Login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'USER_EMAIL' => 'required|email',
            'USER_PASSWORD' => 'required',
        ], [
            'USER_EMAIL.required' => 'The Email field is required.',
            'USER_EMAIL.email' => 'The Email field must be a valid email address.',
            'USER_PASSWORD.required' => 'The Password field is required.',
        ]);

        if (Auth::attempt([
            'USER_EMAIL' => $credentials['USER_EMAIL'],
            'password' => $credentials['USER_PASSWORD'],
        ], $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'USER_EMAIL' => 'Your email or password is incorrect.',
        ])->withInput($request->only('USER_EMAIL', 'remember'));
    }

    public function destroy()
    {
        Auth::logout();

        return Redirect::route('login');
    }
}
