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

    public function login(Request $request)
    {
        // Validate the form data
        $credentials = $request->validate([
            'Login_email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        // Attempt to log the user in
        if (Auth::guard('admin')->attempt($credentials)) {
            // Flash a success message
            $request->session()->flash('success', 'You have successfully logged in.');
            return redirect()->route('login.success'); // Redirect to the dashboard on successful login
        }
    
        // If login failed, redirect back with an error
        return back()->withErrors([
            'Login_email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Show the dashboard after successful login
    public function showLoginSuccess()
    {
        return view('admin.dashboard.dashboard'); // Adjust this path as needed
    }
}