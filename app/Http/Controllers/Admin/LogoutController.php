<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Log the user out

        // Flash a message to the session
        $request->session()->flash('success', 'You have successfully logged out.');

        return redirect()->route('admin.login'); // Redirect to the login page
    }
}