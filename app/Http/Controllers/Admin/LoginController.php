<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('admin.auth.admin-login');
    }
    // Handle login
    public function login(Request $request)
    {
        // Validate the form data
        $credentials = $request->validate([
            'Login_email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // Attempt to log the user in
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('login.success');
        }
        // If login failed, redirect back with an error
        return back()->withErrors([
            'Login_email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showLoginSuccess()
    {
        return view('admin.dashboard.dashboard');
    }
}
