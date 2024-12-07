<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($validated)) {
            return back()->withErrors([
                'not-found' => 'The provided credentials do not match our records.'
            ]);
        }

        request()->session()->regenerate();

        return redirect('/menu');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
