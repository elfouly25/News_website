<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('Login_email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.login.success');
        }

        return back()->withErrors([
            'Login_email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function showLoginSuccess()
    {
        return view('admin.login-success');
    }
}