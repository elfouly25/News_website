<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        // Flash a message to the session
        $request->session()->flash('message', 'Your account has been logged out. Please log in again.');
        return redirect()->route('admin.login'); // Redirect to the login page
    }
}